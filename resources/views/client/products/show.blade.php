@extends('client.layouts.app')

@section('content')
    {{ Breadcrumbs::render('product', $product->category, $product) }}

    <section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($product->media as $key => $image)
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-{{ $key }}" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ $image->getUrl() }}">
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        @foreach($product->media as $key => $image)
                            <div class="tab-pane active" id="tabs-{{ $key }}" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ $image->getUrl() }}" alt="{{ $product->name }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{ $product->name }}</h4>
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

                        <h3>
                            {{ $product->price }} грн
                            @if((int) $product->old_price)
                                <span>{{ $product->old_price }}</span>
                            @endif
                        </h3>

                        @php
                            $currencies = currency()->convertWanted($product->price);
                            array_pop($currencies)
                        @endphp
                       <div class="mb-3">
                           @foreach($currencies as $currency)
                               <h5>
                                   {{ $currency['convert'] }} {{ $currency['currency']->name }}
                               </h5>
                           @endforeach
                       </div>

                        <div class="product__details__option">
                            @foreach($product->characteristics as $characteristic)
                                <div class="product__details__option__size mb-1">
                                    <div class="mt-2">
                                        <span>{{ $characteristic->attribute->name }}</span>
                                    </div>
                                   <div>
                                       <div class="active px-3 py-2 text-white border" style="background: black">
                                           {{ $characteristic->name }}
                                       </div>
                                   </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="product__details__cart__option">
                            <form method="post" action="{{ route('cart.add', $product) }}">
                                @method('POST')
                                @csrf
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input name="quantity" type="number" value="1" min="1" max="{{ $product->quantity }}">
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn btn">
                                    Add To Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            @if($product->description)
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                       role="tab">Опис</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">
                                    Відгуки
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @if($product->description)
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">
                                            {{ $product->description }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                               @include('client.products.inc.reviews', compact('reviews', 'product'))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Схожі товари</h3>
            </div>
        </div>
        <div class="row">
            @foreach($relatedProducts as $product)
                @include('client.products.inc.product', compact('product'))
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.review-reply').forEach(btn => {
                btn.addEventListener('click', e => {
                    const id = btn.dataset.id;
                    const form = document.getElementById('reply-form-' + id);
                    form.classList.toggle('d-none');
                });
            });

            document.querySelectorAll('.review-edit').forEach(btn => {
                btn.addEventListener('click', e => {
                    const id = btn.dataset.id;
                    const form = document.getElementById('edit-form-' + id);
                    form.classList.toggle('d-none');
                });
            });

            document.querySelectorAll('.cancel-edit').forEach(btn => {
                btn.addEventListener('click', e => {
                    const id = btn.dataset.id;
                    const form = document.getElementById('edit-form-' + id);
                    form.classList.add('d-none');
                });
            });
        });
    </script>
@endpush
