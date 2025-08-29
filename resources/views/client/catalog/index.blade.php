@extends('client.layouts.app')

@section('content')

    {{ Breadcrumbs::render('catalog') }}

    <section class="shopping-cart spad">
        <div class="container">

            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ $category->getFirstMediaUrl('image','preview') ?: asset('client/notFound/404.png') }}" style="background-image: url(&quot;/client/img/product/product-2.jpg&quot;);">
                            </div>
                           <div class="p-2">
                               <a href="{{ route('catalog.show', $category->slug) }}">
                                   <h5>
                                       {{ $category->name }}
                                   </h5>
                               </a>
                           </div>
                            <ul class="product_categories-list ">
                                <li class="pl-3">
                                    @if($category->children?->count())
                                        Дочірні категорії:
                                    @endif
                                </li>
                                @foreach($category->children as $category)
                                    <li class="pl-3">
                                        <a href="{{ route('catalog.show', $category->slug) }}">
                                            <h6>
                                                {{ $category->name }}
                                            </h6>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
