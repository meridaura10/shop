<?php

namespace App\Http\Client\web\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        return view('client.favorites.index');
    }
}
