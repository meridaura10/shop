<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Fomvasss\Seo\Facades\Seo;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(Page $page): View
    {
        Seo::setModel($page);

        return view('client.pages.show', compact('page'));
    }
}
