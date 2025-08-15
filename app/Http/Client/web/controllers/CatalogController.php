<?php

namespace App\Http\Client\web\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        return view('client.catalog.index');
    }
}
