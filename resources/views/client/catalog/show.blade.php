@extends('client.layouts.app')

@section('content')
    {{ Breadcrumbs::render('category', $category) }}
    <section class="shop">
        <div class="container">
            <div style="padding: 50px 0px 50px 0px">
                <h2>{{ $category->name }}</h2>
                @if($category->children->isNotEmpty())
                    <h6>
                        Дочірні категорії <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                        </svg>
                    </h6>
                @endif
            </div>
            @if($category->children->isNotEmpty())
                <div class="row">
                        @foreach($category->children as $children)
                            <div class="col-lg-2 col-md-4 col-sm-4">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $children->getFirstMediaUrl('image','preview') ?: asset('client/notFound/404.png')}}">
                                    </div>
                                    <div class="p-2">
                                        <a href="{{ route('catalog.show', $children->slug) }}">
                                            <h5>
                                                {{ $children->name }}
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            @endif
            <div class="row">
                @include('client.catalog.inc.filters', compact('category'))
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select
                                        id="sortPrice"
                                        class="form-select"
                                        onchange="window.location.href = this.value;"
                                    >
                                        <option value="">Сортування</option>
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price', 'order' => 'asc']) }}"
                                            {{ request('sort') == 'price' && request('order') == 'asc' ? 'selected' : '' }}>
                                            Low to High
                                        </option>
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price', 'order' => 'desc']) }}"
                                            {{ request('sort') == 'price' && request('order') == 'desc' ? 'selected' : '' }}>
                                            High to Low
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                            @include('client.products.inc.product', compact('product'))
                        @endforeach
                    </div>
                    <div class="row">
                        {{ $products->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sortSelect = document.getElementById('sortPrice');
        if (sortSelect) {

        }
    });
</script>
@endpush

