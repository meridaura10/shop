@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування атрибута @if($attribute->name) - {{ $attribute->name }}@endif</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.attributes.update', $attribute),
                'files' => true,
                'method' => 'patch',
                'class' => 'js-form-submit-file-changed',
                'style' => 'display: inline-flex',
                'model' => $attribute,
            ]) !!}
            <div class="card-body">


            @include('admin.attributes.inc.form', compact('attribute'))

            </div>
            {!! Lte3::formClose() !!}

        </div>

        @include('admin.characteristics.index', compact('attribute'))

    </section>
@endsection


