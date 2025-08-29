<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Requests\ReviewPutRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Product $product): View
    {
        $reviews = $product->reviews()->get();

        return view('admin.reviews.index', compact('reviews', 'product'));
    }

    public function put(ReviewPutRequest $request, Review $review): JsonResponse
    {
       $review->update([$request->name => $request->value]);

        return response()
            ->json(['message' => trans('lte::alerts.update.success')], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }
}
