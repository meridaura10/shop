@extends('client.layouts.app')

@section('content')
    <section class="py-4">
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Особистий кабінет</h5>
                </div>
                <div class="card-body">
                    <!-- Вкладки -->
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Профіль</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Історія замовлень</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="favorites-tab" data-toggle="tab" href="#favorites" role="tab" aria-controls="favorites" aria-selected="false">Обрані товари</a>
                        </li>
                    </ul>

                    <!-- Вміст вкладок -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Вкладка: Профіль -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h5>Інформація про профіль</h5>
                            <form>
                                <div class="form-group">
                                    <label for="name">Ім'я</label>
                                    <input type="text" class="form-control" id="name" value="Іван Іванов" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="ivan@example.com" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="text" class="form-control" id="phone" value="+380123456789" readonly>
                                </div>
                                <button type="button" class="btn btn-outline-primary">Редагувати профіль</button>
                            </form>
                        </div>

                        <!-- Вкладка: Історія замовлень -->
                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <h5>Історія замовлень</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Замовлення #1001</strong>
                                        <p class="mb-0">Дата: 10.08.2025</p>
                                        <p class="mb-0">Сума: 3500 грн</p>
                                    </div>
                                    <a class="btn btn-outline-dark btn-sm" href="/order/1001">Деталі</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Замовлення #1002</strong>
                                        <p class="mb-0">Дата: 05.08.2025</p>
                                        <p class="mb-0">Сума: 2000 грн</p>
                                    </div>
                                    <a class="btn btn-outline-dark btn-sm" href="/order/1002">Деталі</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Вкладка: Обрані товари -->
                        <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
                            <h5>Обрані товари</h5>
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
                                            <a class="btn btn-outline-dark btn-sm" href="/catalog/category-slug/product-1">Переглянути</a>
                                            <button class="btn btn-outline-danger btn-sm mt-1" onclick="removeFavorite(1)">Видалити</button>
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
                                            <a class="btn btn-outline-dark btn-sm" href="/catalog/category-slug/product-2">Переглянути</a>
                                            <button class="btn btn-outline-danger btn-sm mt-1" onclick="removeFavorite(2)">Видалити</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function removeFavorite(itemId) {
            // Логіка для видалення з обраного (заглушка)
            console.log(`Видалення товару ${itemId} з обраного`);
            // Тут можна додати AJAX-запит до серверу
        }
    </script>
@endsection
