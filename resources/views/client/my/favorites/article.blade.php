<div class="col mt-3">
    <div class="bw-card h-100">
        <div class="bw-thumb ratio-16x9">
            <img src="{{ $articleFavorite->model->getFirstMediaUrl('images','preview') }}" alt="{{ $articleFavorite->model->name }}">
        </div>
        <div class="p-3 text-center">
            <div class="fw-semibold">{{ $articleFavorite->model->name }}</div>
            <div class="d-flex justify-content-center gap-2 mt-2">
                <a href="{{ route('articles.show', $articleFavorite->model) }}" class="btn-bw btn-bw-sm mr-3">Переглянути</a>
                <form method="post" action="{{ route('my.favorites.toggle.favorite', $articleFavorite->model) }}">
                    @method('POST')
                    @csrf
                    <button type="submit" class="btn-bw-outline btn-bw-sm">Видалити</button>
                </form>
            </div>
        </div>
    </div>
</div>
