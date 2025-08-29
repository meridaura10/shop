<?php

namespace App\Http\Admin\Controllers;

use App\Events\ConfirmOrder;
use App\Http\Admin\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Order::class);

        $orders = Order::query()
            ->with('purchases.media')
            ->whereType(Order::TYPE_ORDER)
            ->latest()
            ->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order): View
    {
        $this->authorize('update', $order->load('purchases.media'));

        return view('admin.orders.edit', compact('order'));
    }

    public function update(OrderRequest $request, Order $order): RedirectResponse
    {
        $this->authorize('update', $order);

        $order->update([
            ...$request->getData(),
        ]);

        if($request->status === Order::STATUS_CONFIRMED) {
            event(new ConfirmOrder($order));
        }

        return redirect()->route('admin.orders.edit', $order);
    }

    public function create(): View
    {
        $this->authorize('create', Order::class);

        return view('admin.orders.create');
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        $this->authorize('create', Order::class);

        $order = Order::create($request->getData());

        return redirect()->route('admin.orders.edit', $order);
    }

    public function destroy(Order $order): RedirectResponse
    {
        $this->authorize('delete', $order);

        $order->delete();

        return redirect()->route('admin.orders.index');
    }
}
