@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування статичної сторінки @if($page->name)
                        - {{ $page->name }}
                    @endif</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.pages.update', $page),
                'files' => true,
                'method' => 'patch',
                'class' => 'js-form-submit-file-changed',
                'style' => 'display: inline-flex',
                'model' => $page,
            ]) !!}
            <div class="card-body">


                @include('admin.pages.inc.form', compact('page'))

            </div>
            {!! Lte3::formClose() !!}

        </div>
    </section>
@endsection


