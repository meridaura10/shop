<?php

namespace App\Http\Client\Api\Controllers;

use App\Actions\Checkout;
use App\Http\Client\api\Requests\CheckoutRequest;
use App\Http\Client\api\Requests\ShoppingRequest;
use App\Http\Client\api\Resources\CartResource;
use App\Http\Client\api\Resources\OrderResource;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * @api {get} /cart Show cart
     * @apiName GetCart
     * @apiGroup Cart
     *
     * @apiSuccess {Object} cart Cart object
     * @apiSuccess {Object[]} cart.items List of items in the cart
     * @apiSuccess {Number} cart.items.id Product ID
     * @apiSuccess {String} cart.purchases.name Product name
     * @apiSuccess {Number} cart.purchases.quantity Quantity of the product
     * @apiSuccess {Number} cart.purchases.price Price of the product
     */
    public function show(): CartResource
    {
        $cart = cart()->cart();

        return new CartResource($cart);
    }

    /**
     * @api {post} /cart/add/:product_id Add product to cart
     * @apiName AddToCart
     * @apiGroup Cart
     *
     * @apiParam {Number} product_id Product unique ID.
     *
     * @apiSuccess {String} message Success message
     */
    public function add(Product $product): JsonResponse
    {
        cart()->add($product);

        return response()->json([
            'message' => 'Added to cart',
        ], 201);
    }

    /**
     * @api {delete} /cart/remove/:purchase_id Remove product from cart
     * @apiName RemoveFromCart
     * @apiGroup Cart
     *
     * @apiParam {Number} purchase_id Purchase ID (cart item ID).
     *
     * @apiSuccess {String} message Success message
     */
    public function remove(Purchase $purchase): JsonResponse
    {
        cart()->remove($purchase);

        return response()->json([
            'message' => 'Removed from cart',
        ], 200);
    }

    /**
     * @api {put} /cart/shopping Update cart details
     * @apiName UpdateCart
     * @apiGroup Cart
     *
     * @apiBody {String} address order.
     *
     * @apiSuccess {String} message Success message
     */
    public function shopping(ShoppingRequest $request): JsonResponse
    {
        cart()->update([
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'saved',
        ]);
    }

    /**
     * @api {post} /cart/checkout Checkout
     * @apiName Checkout
     * @apiGroup Cart
     *
     *
     * @apiSuccess {Object} order Order object
     * @apiSuccess {Number} order.id Order ID
     * @apiSuccess {String} order.status Order status
     * @apiSuccess {Object} order.payment Payment details
     */
    public function checkout(CheckoutRequest $request): OrderResource
    {
        $data = $request->validated();

        $order = Checkout::run($data);

        return new OrderResource($order->load('payment'));
    }
}
