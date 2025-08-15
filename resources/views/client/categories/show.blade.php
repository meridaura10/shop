@extends('client.layouts.app')

@section('content')
    <section class="py-4">
        <div class="container-fluid px-4">
            <!-- Інформація про категорію -->
            <div class="card mb-4">
                <img class="card-img-top" src="https://dummyimage.com/300x100/dee2e6/6c757d.jpg" alt="Електроніка" />
                <div class="card-body text-center">
                    <h3 class="card-title">Електроніка</h3>
                    <p class="card-text">Ласкаво просимо до категорії "Електроніка"! Тут ви знайдете широкий вибір сучасних гаджетів: смартфони, ноутбуки, аксесуари та багато іншого. Наші продукти поєднують інновації, якість і доступні ціни.</p>
                </div>
            </div>

            <!-- Вкладений список категорій -->
            @php
                // Умова для демонстрації (замінити на реальну логіку)
                $hasSubcategories = true; // true - є підкатегорії, false - немає
            @endphp

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Підкатегорії</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <!-- Основна категорія -->
                        <li class="list-group-item">
                            <a class="d-flex justify-content-between align-items-center text-decoration-none" href="/category/electronics">
                                Електроніка
                                @if ($hasSubcategories)
                                    <i class="bi bi-chevron-down" data-toggle="collapse" href="#electronicsCollapse" role="button" aria-expanded="false" aria-controls="electronicsCollapse"></i>
                                @endif
                            </a>
                            @if ($hasSubcategories)
                                <div class="collapse" id="electronicsCollapse">
                                    <ul class="list-group list-group-flush ml-3">
                                        <!-- Підкатегорія: Смартфони -->
                                        <li class="list-group-item">
                                            @php
                                                $hasSubSubcategories = true; // Умова для підкатегорій Смартфонів
                                            @endphp
                                            <a class="d-flex justify-content-between align-items-center text-decoration-none" href="/category/electronics/phones">
                                                Смартфони
                                                @if ($hasSubSubcategories)
                                                    <i class="bi bi-chevron-down" data-toggle="collapse" href="#phonesCollapse" role="button" aria-expanded="false" aria-controls="phonesCollapse"></i>
                                                @endif
                                            </a>
                                            @if ($hasSubSubcategories)
                                                <div class="collapse" id="phonesCollapse">
                                                    <ul class="list-group list-group-flush ml-3">
                                                        <li class="list-group-item"><a href="/category/electronics/phones/ios">iOS</a></li>
                                                        <li class="list-group-item"><a href="/category/electronics/phones/android">Android</a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>
                                        <!-- Підкатегорія: Ноутбуки -->
                                        <li class="list-group-item">
                                            @php
                                                $hasSubSubcategoriesLaptops = false; // Умова для підкатегорій Ноутбуків
                                            @endphp
                                            <a class="d-flex justify-content-between align-items-center text-decoration-none" href="/category/electronics/laptops">
                                                Ноутбуки
                                                @if ($hasSubSubcategoriesLaptops)
                                                    <i class="bi bi-chevron-down" data-toggle="collapse" href="#laptopsCollapse" role="button" aria-expanded="false" aria-controls="laptopsCollapse"></i>
                                                @endif
                                            </a>
                                            @if ($hasSubSubcategoriesLaptops)
                                                <div class="collapse" id="laptopsCollapse">
                                                    <ul class="list-group list-group-flush ml-3">
                                                        <li class="list-group-item"><a href="/category/electronics/laptops/gaming">Ігрові</a></li>
                                                        <li class="list-group-item"><a href="/category/electronics/laptops/ultrabooks">Ультрабуки</a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>
                                        <li class="list-group-item"><a href="/category/electronics/accessories">Аксесуари</a></li>
                                    </ul>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Список товарів категорії -->
            <div class="mt-4">
                <h4 class="mb-3">Товари категорії</h4>
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
                    <!-- Товар 4 -->
                    <div class="col">
                        <div class="card h-100">
                            <img class="card-img-top" src="https://dummyimage.com/150x100/dee2e6/6c757d.jpg" alt="Товар 4" />
                            <div class="card-body p-2 text-center">
                                <h6 class="mb-0">Товар 4</h6>
                                <p class="mb-0">2500 грн</p>
                            </div>
                            <div class="card-footer p-2 pt-0 border-top-0 bg-transparent text-center">
                                <a class="btn btn-outline-dark btn-sm" href="/catalog/electronics/product-4">Переглянути</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
