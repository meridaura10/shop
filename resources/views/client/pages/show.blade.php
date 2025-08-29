@extends('client.layouts.app')

@section('content')
    {{ Breadcrumbs::render('page', $page) }}

    <section class="about spad">
        <div class="container">
           <div class="row">
               {!! $page->content !!}
           </div>
        </div>
    </section>
@endsection
