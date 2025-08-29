@extends('client.layouts.errors')

@section('content')
    <section class="py-5">
        <div class="container text-center">
            <h1 class="display-1 fw-bold text-warning">403</h1>
            <h3 class="mb-3">Доступ заборонено</h3>
            <p class="text-muted mb-4">
                У вас немає прав для перегляду цієї сторінки.
            </p>
            <a href="{{ route('home')  }}" class="btn btn-primary">На головну</a>
        </div>
    </section>
@endsection
