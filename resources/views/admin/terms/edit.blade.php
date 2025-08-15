@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування {{$vocabulary['name']}} @if($term->name) - {{ $term->name }}@endif</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.terms.update', $term),
                'files' => true,
                'method' => 'patch',
                'style' => 'display: inline-flex',
                'model' => $term,
            ]) !!}
            <div class="card-body">

                @include('admin.terms.inc.form', compact('term'))

            </div>
            {!! Lte3::formClose() !!}

        </div>
    </section>
@endsection



