<div class="col mt-3">
    <div class="bw-card h-100">
        <div class="bw-thumb ratio-16x9">
            <img src="{{ $productFavorite->model->getFirstMediaUrl('images','preview') }}" alt="{{ $productFavorite->model->name }}">
        </div>
        <div class="p-3 text-center">
            <div class="fw-semibold">{{ $productFavorite->model->name }}</div>
            <div class="fw-bold mt-1">{{ $productFavorite->model->price }} грн</div>
            <div class="d-flex justify-content-center gap-2 mt-2">
                <a href="{{ route('catalog.products.show', [
                                                        'category' => $productFavorite->model->category->slug,
                                                        'product' => $productFavorite->model->slug,
                                                    ]) }}" class="btn-bw btn-bw-sm">Переглянути</a>
                <form method="post" action="{{ route('my.favorites.toggle.product', $productFavorite->model) }}">
                    @method('POST')
                    @csrf
                    <button type="submit" class="btn-bw-outline btn-bw-sm">Видалити</button>
                </form>
            </div>
        </div>
    </div>
</div>
