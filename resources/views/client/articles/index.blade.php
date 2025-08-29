@extends('client.layouts.app')

@section('content')
    {{ Breadcrumbs::render('blog') }}

    <section class="breadcrumb-blog set-bg" data-setbg="client/img/breadcrumb-bg.jpg" style="background-image: url(&quot;img/breadcrumb-bg.jpg&quot;);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Our Blog</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach($articles as $article)
                    @include('client.articles.inc.article', compact('article'))
                @endforeach
            </div>
        </div>
    </section>
@endsection
