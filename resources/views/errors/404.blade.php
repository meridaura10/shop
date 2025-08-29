@extends('client.layouts.errors')

@section('content')
    <section class="py-5">
        <div class="container text-center">
            <h1 class="display-1 fw-bold text-danger">404</h1>
            <h3 class="mb-3">Сторінку не знайдено</h3>
            <p class="text-muted mb-4">
                Вибачте, але сторінка яку ви шукаєте не існує.
            </p>
            <a href="{{ route('home')  }}" class="btn btn-primary">На головну</a>
        </div>
    </section>
@endsection
