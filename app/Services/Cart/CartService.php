<?php

namespace App\Services\Cart;

use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartService
{
    protected ?Order $cart = null;
    protected ?User $user = null;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function purchases(array $load = []): Collection
    {
        return $this->cart()->load($load)->purchases;
    }

    public function clear(): static
    {
        $this->cart()->purchases()->delete();

        return $this;
    }

    public function updateQuantity(Purchase $purchase, int $quantity = 1): static
    {
        if ($quantity < 1) {
            $quantity = 1;
        }

        $quantity = $purchase->quantity + $quantity;

        if (!$this->checkQuantity($purchase->product, $quantity)) {
            return $this;
        }

        $purchase->update(['quantity' => $quantity]);

        return $this;
    }

    public function checkQuantity(Product $product, int $quantity): bool
    {
        return $product->quantity >= $quantity;
    }

    public function remove(Purchase $purchase): static
    {
        $purchase->delete();
        return $this;
    }

    public function add(Product $product, int $quantity = 1): static
    {
        if (!$this->checkQuantity($product, $quantity)) {
            return $this;
        }

        DB::transaction(function () use ($product, $quantity) {
            try {
                $purchase = $this->cart()->purchases()->firstWhere('product_id', $product->id);
                $purchase
                    ? $this->updateQuantity($purchase, $quantity)
                    : $this->storePurchase($product, $quantity);
            } catch (\Throwable $throwable) {
                dd($throwable);
            }
        });

        return $this;
    }

    public function load()
    {

    }

    public function cart(): Order
    {
        if ($this->cart) {

            return $this->cart;
        }

        $userCart = $this->getUserCart();
        $cookieCart = $this->getCookieCart($userCart);

        $cart = $userCart ?? $cookieCart;

        if ($cookieCart && $userCart) {
            $this->merge($cookieCart, $cart);
        }


        if (!$cart) {
            $cart = $this->storeCart();
        }

        return $this->cart = $cart;
    }

    public function storePurchase(Product $product, int $quantity = 1): Purchase
    {
        $purchase = $this->cart()->purchases()->create([
            'name' => $product->name,
            'price' => $product->price,
            'old_price' => $product->old_price,
            'quantity' => $quantity,
            'product_id' => $product->id,
        ]);

        if ($media = $product->getFirstMedia('images')) {
            $purchase->addMedia($media->getPath())
                ->preservingOriginal()
                ->toMediaCollection('image');
        }

        return $purchase;
    }

    public function storeCart(): Order
    {
        $cart = Order::create([
            'type' => Order::TYPE_CART,
            'user_id' => $this->user?->id,
        ]);

        Cookie::queue('cart', $cart->id, 60 * 24 * 30);

        return $cart;
    }

    public function getCookieCart(?Order $cart): ?Order
    {
        $id = request()->cookie('cart');

        return Order::query()
            ->whereNot('id', $cart?->id)
            ->where('type', Order::TYPE_CART)
            ->find($id);
    }

    public function getUserCart(): ?Order
    {
        return $this->user?->cart;
    }

    public function merge(Order $sourceCart, Order $targetCart): void
    {
        $targetPurchases = $targetCart->purchases->keyBy(fn($p) => $p->product_id);

        foreach ($sourceCart->purchases as $oldPurchase) {
            $product = $oldPurchase->product;

            if (!$product) {
                continue;
            }

            $existingPurchase = $targetPurchases[$product->id] ?? null;

            if ($existingPurchase) {
                $existingPurchase->update([
                    'quantity'   => $oldPurchase->quantity,
                    'price'      => $product->price,
                    'old_price'  => $product->old_price,
                    'name'       => $product->name,
                ]);

                $oldPurchase->delete();
            } else {
                $oldPurchase->update([
                    'order_id' => $targetCart->id,
                ]);
            }
        }
    }

    public function checkout(array $data): Order
    {
        $cart = $this->cart();

        $this->syncPurchaseToOrder($cart);

        $cart->update([
            'type' => Order::TYPE_ORDER,
            'amount' => $cart->purchases()->get()->sum('amount'),
            'status' => Order::STATUS_PENDING,
            'address' => $data['address'] ?: $cart->address ?? null,
            'customer' => $data['customer'] ?: $cart->customer ?? null,
        ]);



        return $cart;
    }

    public function syncPurchaseToOrder(Order $order): Order
    {
        if ($order->purchases()->doesntExist()) {
            throw ValidationException::withMessages([
                'cart' => 'Корзина пуста.',
            ]);
        }

        $purchases = $order->purchases()->with('product')->get();

        foreach ($purchases as $purchase) {
            if (!$this->checkQuantity($purchase->product, $purchase->quantity)) {
                $available = $purchase->product->quantity;
                throw ValidationException::withMessages([
                    'order' => "На складі доступно лише {$available} шт. товару «{$purchase->product->name}».",
                ]);
            }

            $product = $purchase->product;

            $product->update(['quantity' => $product->quantity - $purchase->quantity]);
        }

        return $order;
    }

    public function update(array $data): static
    {
        $this->cart()->update($data);

        return $this;
    }

    public function totalPrice(): float
    {
        return $this->purchases()->sum('amount');
    }

    public function totalQuantity(): int
    {
        return $this->purchases()->sum('quantity');
    }
}
