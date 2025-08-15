<?php

namespace App\Http\Admin\Controllers;

use App\Http\controllers\Controller;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
//        dd(currency()->convertWanted(10));

        $dashboardStats = cache()->remember('dashboard:stats', 3000, function () {
            return [
                'orders' => [
                    'total' => Order::whereType(Order::TYPE_ORDER)->count(),
                ],
                'products' => [
                    'total' => Product::count(),
                ],
                'leads' => [
                    'total' => Lead::count(),
                ],
                'users' => [
                    'total' => User::query()->doesntHave('roles')->count(),
                ],
            ];
        });

        $dashboardStats['orders']['new'] = Order::whereType(Order::TYPE_ORDER)->limit(20)->latest()->get();

        return view('admin.home', [
            'dashboardStats' => $dashboardStats,
        ]);}
}
