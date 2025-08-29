<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Admin\Requests\ReviewRequest;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function update(ReviewRequest $request, Review $review): RedirectResponse
    {
        $this->authorize('update', $review);

        $review->update($request->getData());

        return redirect()->back();
    }

    public function store(ReviewRequest $request): RedirectResponse
    {
        $this->authorize('create', Review::class);

        Review::create([
            'name' => $request->user()->name ?? null,
            'user_id' => $request->user()->id,
            ...$request->getData(),
        ]);

        return redirect()->back();
    }

    public function destroy(Review $review): RedirectResponse
    {
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->back();
    }
}
