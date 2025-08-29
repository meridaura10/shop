<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="blog__item">
        <div class="blog__item__pic set-bg" data-setbg="{{ $article->getFirstMediaUrl('images','preview') ?: asset('client/notFound/404.png') }}"></div>
        <div class="blog__item__text">
            <div class="d-flex justify-content-between">
                <div>
                    <span><img src="/client/img/icon/calendar.png" alt="date">{{ $article->created_at->format('d F Y') }}</span>
                    <h5>{{ $article->name }}</h5>
                    <a href="{{ route('articles.show', $article->slug) }}">Read More</a>
                </div>
                <form method="post" action="{{ route('my.favorites.toggle.favorite', $article) }}">
                    @method('POST')
                    @csrf
                    <button type="submit" style="background: transparent; border: none; padding: 0px; margin: 0px">
                        <img @if(favorite()->isFavorite($article)) style="padding: 5px" @endif src="{{ favorite()->isFavorite($article) ? "/client/img/heart/heart-fill.png" : "/client/img/icon/heart.png" }}" alt="is favorite">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
