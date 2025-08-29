<?php

namespace App\Http\Client\web\Controllers;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $purchases = cart()->purchases(['purchases.media' , 'purchases.product']);

        return view('client.cart.index', compact('purchases'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $request->validate(['quantity' => ['nullable', 'integer', 'min:1', 'max:'.$product->quantity]]);

        cart()->add($product, $request->input('quantity') ?? 1);

        return redirect()->back();
    }

    public function update(Request $request, Purchase $purchase): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                Rule::when($purchase->product, fn() => 'max:'. $purchase->product->quantity)],
        ]);

        cart()->updateQuantity($purchase, $data['quantity']);

        return redirect()->back();
    }

    public function remove(Purchase $purchase): RedirectResponse
    {
        cart()->remove($purchase);

        return redirect()->route('cart.index');
    }

    public function clear(): RedirectResponse
    {
        cart()->clear();

        return redirect()->route('cart.index');
    }
}
