@extends('client.layouts.app')

@section('content')
    {{ Breadcrumbs::render('article', $article) }}

    <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        <h2>{{ $article->name }}</h2>
                        <ul>
                            <li>{{ $article->created_at->format('d F Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="blog__details__pic">
                        <img src="{{ $article->getFirstMediaUrl('images','preview') ?: asset('client/notFound/404.png') }}" alt="{{ $article->name }}">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__text">
                          {{ $article->body }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
