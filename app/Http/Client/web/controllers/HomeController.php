<?php

namespace App\Http\client\web\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('client.pages.home');
    }
}
