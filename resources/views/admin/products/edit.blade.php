@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування продукта @if($product->name) - {{ $product->name }}@endif</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.products.update', $product),
                'files' => true,
                'method' => 'patch',
                'style' => 'display: inline-flex',
                'model' => $product,
            ]) !!}
            <div class="card-body">


            @include('admin.products.inc.form', compact('product','attributes'))

            </div>
            {!! Lte3::formClose() !!}

        </div>
    </section>
@endsection


