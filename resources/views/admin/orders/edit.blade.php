@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування замовлення {{ $order->id }}</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.orders.update', $order),
                'files' => true,
                'method' => 'patch',
                'class' => 'js-form-submit-file-changed',
                'style' => 'display: inline-flex',
                'model' => $order,
            ]) !!}
            <div class="card-body">


            @include('admin.orders.inc.form', compact('order'))

            </div>
            {!! Lte3::formClose() !!}

            <div class="card-body">
                @include('admin.purchases.index')
            </div>

        </div>
    </section>
@endsection


