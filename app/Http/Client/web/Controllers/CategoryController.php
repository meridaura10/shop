<?php

namespace App\Http\Client\web\Controllers;

use Illuminate\View\View;

class CategoryController
{
    public function show(): View
    {
        return view('client.categories.show');
    }
}
