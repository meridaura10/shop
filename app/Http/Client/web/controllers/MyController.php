<?php

namespace App\Http\Client\web\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MyController extends Controller
{
    public function profile(): View
    {
        return view('client.my.index');
    }
}
