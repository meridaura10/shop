@extends('client.layouts.app')

@section('content')
    <section class="py-4">
        <div class="container-fluid px-4">
            <!-- Поле пошуку -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="/search" method="GET">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" placeholder="Введіть назву товару..." value="{{ request()->query('query') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Пошук</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Результати пошуку -->
            <div class="mt-4">
                <h4 class="mb-3">Результати пошуку</h4>
                @if (!empty($products) && count($products) > 0)
                    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-6 gx-3 gy-3">
                        <!-- Товар 1 -->
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="https://dummyimage.com/150x100/dee2e6/6c757d.jpg" alt="Товар 1" />
                                <div class="card-body p-2 text-center">
                                    <h6 class="mb-0">Товар 1</h6>
                                    <p class="mb-0">1500 грн</p>
                                </div>
                                <div class="card-footer p-2 pt-0 border-top-0 bg-transparent text-center">
                                    <a class="btn btn-outline-dark btn-sm" href="/catalog/electronics/product-1">Переглянути</a>
                                </div>
                            </div>
                        </div>
                        <!-- Товар 2 -->
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="https://dummyimage.com/150x100/dee2e6/6c757d.jpg" alt="Товар 2" />
                                <div class="card-body p-2 text-center">
                                    <h6 class="mb-0">Товар 2</h6>
                                    <p class="mb-0">2000 грн</p>
                                </div>
                                <div class="card-footer p-2 pt-0 border-top-0 bg-transparent text-center">
                                    <a class="btn btn-outline-dark btn-sm" href="/catalog/electronics/product-2">Переглянути</a>
                                </div>
                            </div>
                        </div>
                        <!-- Товар 3 -->
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="https://dummyimage.com/150x100/dee2e6/6c757d.jpg" alt="Товар 3" />
                                <div class="card-body p-2 text-center">
                                    <h6 class="mb-0">Товар 3</h6>
                                    <p class="mb-0">1000 грн</p>
                                </div>
                                <div class="card-footer p-2 pt-0 border-top-0 bg-transparent text-center">
                                    <a class="btn btn-outline-dark btn-sm" href="/catalog/electronics/product-3">Переглянути</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p>Нічого не знайдено за вашим запитом.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
