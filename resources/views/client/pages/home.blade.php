@extends('client.layouts.app')

@section('content')
    <section class="product spad">
        <div class="container">
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <ul class="filter__controls">--}}
{{--                        <li class="active" data-filter="*">Best Sellers</li>--}}
{{--                        <li data-filter=".new-arrivals">New Arrivals</li>--}}
{{--                        <li data-filter=".hot-sales">Hot Sales</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row product__filter">
                @foreach($products as $product)
                    @include('client.products.inc.product', compact('product'))
                @endforeach
            </div>
        </div>
    </section>

    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Latest News</span>
                        <h2>Fashion New Trends</h2>
                    </div>
                </div>
            </div>
            <div class="row">
               @foreach($articles as $article)
                   @include('client.articles.inc.article', compact('article'))
               @endforeach
            </div>
        </div>
    </section>
@endsection
