<div>
    @if(auth()->check())
        <form action="{{ route('reviews.store') }}" method="post">
            @csrf
            <input type="hidden" name="model_type" value="{{ \App\Models\Product::class }}">
            <input type="hidden" name="model_id" value="{{ $product->id }}">

            <textarea name="description" class="form-control mb-2" rows="3" placeholder="Ваша відгук"></textarea>

            <div class="mb-2">
                <label>Оцінка:</label>
                <div class="d-flex gap-2">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}">
                            <label class="form-check-label" for="rating-{{ $i }}">{{ $i }} &#9733;</label>
                        </div>
                    @endfor
                </div>
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Надіслати</button>
        </form>
    @endif

    <div class="product__details__tab__content">
        @foreach($reviews as $review)
            @include('client.products.inc.review', ['review' => $review])
        @endforeach
    </div>
</div>
