<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            @if(!auth()->check())
                                <a href="{{ route('login') }}">Sign in</a>
                            @else
                                <form method="post" action="{{ route('logout') }}">
                                    <a href="{{ route('my.profile') }}">
                                        Профіль
                                    </a>
                                    @can('admin.auth')
                                        <a href="{{ route('admin.home') }}">
                                            адмінка
                                        </a>
                                    @endcan
{{--                                    @method('POST')--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" style="background: transparent; border: none; color: white">--}}
{{--                                            Профіль--}}
{{--                                    </button>--}}
                                </form>
                            @endif
                        </div>
{{--                        <div class="header__top__hover">--}}
{{--                            <span>Usd <i class="arrow_carrot-down"></i></span>--}}
{{--                            <ul>--}}
{{--                                <li>USD</li>--}}
{{--                                <li>EUR</li>--}}
{{--                                <li>USD</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="/client/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li @if(request()->routeIs('home')) class="active" @endif><a href="{{ route('home') }}">Home</a></li>
                        <li @if(request()->routeIs('catalog.index')) class="active" @endif><a href="{{ route('catalog.index') }}">Catalog</a></li>
                        <li @if(request()->routeIs('articles.index')) class="active" @endif><a href="{{ route('articles.index') }}">Blog</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                @foreach($pages as $page)
                                    <li @if(request()->routeIs('pages.show', $page->slug)) class="active" @endif>
                                        <a href="{{ route('pages.show', $page->slug) }}">{{ $page->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="{{ route('cart.index') }}"><img src="/client/img/icon/cart.png" alt=""></a>
                    <div class="price">{{ cart()->totalQuantity() }}</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
