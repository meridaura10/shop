@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма створення статичної сторінки</h3>
            </div>
            {!! Lte3::formOpen([
                'action' => route('admin.pages.store'),
                'files' => true,
                'method' => 'post',
                'class' => 'js-form-submit-file-changed',
                'style' => 'display: inline-flex',
             ]) !!}
            <div class="card-body">


                @include('admin.pages.inc.form')

            </div>
            {!! Lte3::formClose() !!}
        </div>
    </section>

@endsection
