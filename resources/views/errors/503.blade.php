@extends('client.layouts.errors')

@section('content')
    <section class="py-5">
        <div class="container text-center">
            <h1 class="display-1 fw-bold text-secondary">503</h1>
            <h3 class="mb-3">Сервіс тимчасово недоступний</h3>
            <p class="text-muted mb-4">
                Ми вже працюємо над усуненням проблеми. Спробуйте пізніше.
            </p>
            <a href="{{ route('home')  }}" class="btn btn-primary">На головну</a>
        </div>
    </section>
@endsection
