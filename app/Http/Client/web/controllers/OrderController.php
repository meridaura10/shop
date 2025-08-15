<?php

namespace App\Http\Client\web\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout(): View
    {
        return view('client.orders.checkout');
    }
}
