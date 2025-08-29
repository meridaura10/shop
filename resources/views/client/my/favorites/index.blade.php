@if(auth()->check())
    <div class="tab-pane-bw" id="favoriteProducts" role="tabpanel">
        <h5 class="fw-semibold mb-3">Обрані товари</h5>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3">
            @foreach(favorite()->getTypeFavorites(\App\Models\Product::class) as $productFavorite)
                @include('client.my.favorites.product')
            @endforeach
        </div>
    </div>
    <div class="tab-pane-bw" id="favoriteArticles" role="tabpanel">
        <h5 class="fw-semibold mb-3">Обрані статті</h5>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3">
            @foreach(favorite()->getTypeFavorites(\App\Models\Article::class) as $articleFavorite)
                @include('client.my.favorites.article')
            @endforeach
        </div>
    </div>
@endif
