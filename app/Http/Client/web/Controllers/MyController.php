<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Admin\Requests\ProfileRequest;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MyController extends Controller
{
    public function profile(): View
    {
        $user = auth()->user()->load('orders', 'media', 'favorites.model.media', 'favorites.model.category');

        return view('client.my.index', compact('user'));
    }

    public function updateProfile(ProfileRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = auth()->user();

        $user->update([
            ...$data,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('my.profile');
    }

    public function orderShow(Order $order): View
    {
        $order->load('purchases', 'payment');

        return view('client.my.orders.show', compact('order'));
    }
}
