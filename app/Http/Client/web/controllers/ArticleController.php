<?php

namespace App\Http\Client\web\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('client.articles.index');
    }

    public function show(): View
    {

        return view('client.articles.show');
    }
}
