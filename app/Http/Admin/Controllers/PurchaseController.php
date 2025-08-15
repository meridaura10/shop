<?php

namespace App\Http\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Intervention\Image\Colors\Rgb\Channels\Red;

class PurchaseController extends Controller
{
   public function update(PurchaseRequest $request, Purchase $purchase): RedirectResponse
   {
       $purchase->update([$request->name => $request->value]);

       return redirect()->route('admin.orders.edit', $purchase->order_id);
   }

    public function put(Request $request, Purchase $purchase): JsonResponse
    {
        $purchase->update([$request->name => $request->value]);

        return response()
            ->json(['message' => trans('lte::alerts.update.success')], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }


    public function store(PurchaseRequest $request, Order $order): RedirectResponse
   {
       $product = Product::query()->find($request->product_id);

       $purchaseData = [
           'name' => $product->name,
           'price' => $request->price ? $request->price : $product->price,
           'quantity' => $request->quantity,
           'old_price' => $request->old_price ? $request->quantity : $product->old_price,
       ];

       $purchase = $order->purchases()->create($purchaseData);

       if ($media = $product->getFirstMedia('images')) {
           $media->copy($purchase, 'image');
       }

       return redirect()->route('admin.orders.edit', $order);
   }

   public function destroy(Purchase $purchase): RedirectResponse
   {
       $purchase->delete();

       return redirect()->route('admin.orders.edit', $purchase->order_id);
   }
}
