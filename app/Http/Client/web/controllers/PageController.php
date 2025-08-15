<?php

namespace App\Http\Client\web\controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(Page $page): View
    {
        return view('client.pages.show', compact('page'));
    }
}
