@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування ролі @if($role->name) - {{ $role->name }}@endif</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.roles.update', $role),
                'files' => true,
                'method' => 'patch',
                'style' => 'display: inline-flex',
                'model' => $role,
            ]) !!}
            <div class="card-body">


                @include('admin.roles.inc.form', compact('role'))

            </div>
            {!! Lte3::formClose() !!}

        </div>
    </section>
@endsection



