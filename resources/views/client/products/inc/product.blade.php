<div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
    <div class="product__item">
        <div class="product__item__pic set-bg"
             data-setbg="{{ $product->getFirstMediaUrl('images', 'preview') ?: asset('client/notFound/404.png') }}">            {{--                                <span class="label">New</span>--}}
            <ul class="product__hover">
                <li>
                    <form method="post" action="{{ route('my.favorites.toggle.product', $product) }}">
                        @method('POST')
                        @csrf
                        <button type="submit" style="background: transparent; border: none; padding: 0px; margin: 0px">
                         <img style="padding-left: 6px" src="{{ favorite()->isFavorite($product) ? "/client/img/heart/heart-fill.png" : "/client/img/icon/heart.png" }}" alt="is favorite">
                        </button>
                    </form>
                </li>

                <li><a href="{{ route('catalog.products.show',['category' => $product->category->slug,'product' => $product->slug]) }}"><img src="/client/img/icon/search.png" alt=""></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6>{{ $product->name }}</h6>
            <form method="post" action="{{ route('cart.add', $product) }}">
                @method('POST')
                @csrf
                <button type="submit" style="background: transparent; border: none; padding: 0px; margin: 0px">
                    @if($product->quantity)
                        <a class="add-cart">+ Add To Cart</a>
                        @else
                        <a >Немає в наявності</a>
                    @endif
                </button>
            </form>
            <div class="rating">
                @if($product->rating)
                    @for ($i = 1; $i <= 5; $i++)
                        @if($product->rating >= $i)
                            <i class="fa fa-star"></i>
                        @else
                            <i class="fa fa-star-o"></i>
                        @endif
                    @endfor

                    @else
                    <p>немає вудгуків</p>
                @endif
            </div>
            <h5>{{ $product->price }} грн</h5>
        </div>
    </div>
</div>
