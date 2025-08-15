<?php

namespace App\Http\Client\web\controllers;

use Illuminate\View\View;

class CategoryController
{
    public function show(): View
    {
        return view('client.categories.show');
    }
}
