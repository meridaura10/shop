<div class="mb-3">
    <div class="border border-gray p-3 rounded-lg">
        <span class="font-weight-bold">{{ $review->name }}</span>

        @if($review->rating)
            <div class="mt-1 mb-1">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star {{ $i <= $review->rating ? 'star-filled' : '' }}">&#9733;</span>
                @endfor
            </div>
        @endif

        <div>
            <p class="review-text">{{ $review->description }}</p>
        </div>

        <div class="d-flex align-items-center position-relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-arrow-return-right mr-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5.5 0 0 0 2.5 2.5h9.793l-3.347
                      3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0
                      0-.708l-4-4a.5.5 0 0 0-.708.708L13.293
                      8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0
                      0-.5-.5"/>
            </svg>

            <span style="cursor: pointer" class="review-reply text-primary" data-id="{{ $review->id }}" role="button">Відповісти</span>
            <span style="cursor: pointer" class="reply-close text-danger d-none ml-2" data-id="{{ $review->id }}" role="button">&times;</span>

            @can('update', $review)
                <div style="cursor: pointer">
                    <span class="review-edit text-warning ml-2" data-id="{{ $review->id }}" role="button">Редагувати</span>
                </div>
            @endcan

            @can('delete', $review)
                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline pointer-event ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link p-0 text-danger" style="font-size: 1rem;">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            @endcan
        </div>

        <div class="reply-form mt-2 d-none" id="reply-form-{{ $review->id }}">
            @if(auth()->check())
                <form action="{{ route('reviews.store', $review) }}" method="post">
                    @csrf

                    <input type="hidden" name="model_type" value="{{ \App\Models\Product::class }}">
                    <input type="hidden" name="model_id" value="{{ $product->id }}">
                    <input type="hidden" name="parent_id" value="{{ $review->id }}">
                    <textarea name="description" class="form-control mb-2" rows="3" placeholder="Ваша відповідь"></textarea>
                    <button type="submit" class="btn btn-sm btn-primary">Надіслати</button>
                </form>
            @else
                <p>Спочатку авторизуйтесь <a href="{{ route('login') }}">Ввійти</a></p>
            @endif
        </div>

        @can('update', $review)
            <div class="edit-form mt-2 d-none" id="edit-form-{{ $review->id }}">
                <form action="{{ route('reviews.update', $review) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="model_type" value="{{ \App\Models\Product::class }}">
                    <input type="hidden" name="model_id" value="{{ $product->id }}">
                    <input type="hidden" name="parent_id" value="{{ $review->parent_id }}">
                    <textarea name="description" class="form-control mb-2" rows="3">{{ $review->description }}</textarea>

                    @if(!$review->parent_id)
                        <div class="mb-2">
                            <label>Рейтинг:</label>
                            <div class="d-flex gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rating" value="{{ $i }}" {{ $i == $review->rating ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $i }} &#9733;</label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-sm btn-success">Оновити</button>
                    <button type="button" class="btn btn-sm btn-secondary cancel-edit" data-id="{{ $review->id }}">Скасувати</button>
                </form>
            </div>
        @endcan
    </div>

    <div class="border-left pl-3 mt-2 mb-2">
        @foreach($review->children as $child)
            @include('client.products.inc.review', ['review' => $child])
        @endforeach
    </div>
</div>

