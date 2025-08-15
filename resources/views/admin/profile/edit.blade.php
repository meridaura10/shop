@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування профіля @if($user->name) - {{ $user->name }}@endif</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.profile.update', $user),
                'files' => true,
                'method' => 'patch',
                'style' => 'display: inline-flex',
                'model' => $user,
            ]) !!}
            <div class="card-body">

                @include('admin.profile.inc.form', compact('user'))

            </div>
            {!! Lte3::formClose() !!}

        </div>
    </section>
@endsection


