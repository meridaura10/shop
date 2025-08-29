<?php

namespace App\Http\Admin\Controllers;

use App\Actions\SitemapGenerate;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Orchestra\Parser\Xml\Facade as XmlParser;

class SettingController extends Controller
{
    public function sitemap(): JsonResponse
    {
        $xml = XmlParser::load(storage_path('app/public/sitemap.xml'));

        return response()->json($xml->getContent());
    }

    public function sitemapStore(): RedirectResponse
    {
        SitemapGenerate::dispatch();

        return redirect()->back();
    }
}
