@extends('client.layouts.app')

@section('content')
    {{ Breadcrumbs::render('cart') }}

    <section class="shopping-cart spad">
        <div class="container">
            @if($purchases->isEmpty())
                <div class="p-4 text-center border rounded bg-light">
                    <p class="mb-2">🛒 Ваша корзина порожня</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary">Перейти до покупок</a>
                </div>
                @else
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($purchases as $purchase)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic" style="width: 120px; height: auto">
                                                <img src="{{ $purchase->getFirstMediaUrl('image','preview') }}" alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $purchase->name }}</h6>
                                                <h5>{{ $purchase->price }}грн</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input
                                                        data-purchase-id="{{ $purchase->id }}"
                                                        max="{{ $purchase->product?->quantity }}"
                                                        min="1"
                                                        type="text"
                                                        value="{{ $purchase->quantity }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price">{{ $purchase->amount }}.грн</td>
                                        <td class="cart__close">
                                            <form method="post" action="{{ route('cart.remove', $purchase) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" style="background: transparent; border: none">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @method('POST')
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0" style="border: none; background: none;">
                                            Очистити
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__total">
                            <h6>Cart total</h6>
                            <ul>
                                <li>Total <span>{{ cart()->totalPrice() }}</span></li>
                            </ul>
                            <a href="{{ route('checkout.index') }}" class="primary-btn">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let debounceTimer;

        function processQuantity(input, mode = "immediate") {
            let val = parseInt(input.value) || 1;
            let min = parseInt(input.min) || 1;
            let max = parseInt(input.max) || Infinity;

            if (val < min) val = min;
            if (val > max) val = max;

            input.value = val;
            const purchaseId = input.dataset.purchaseId;

            fetch(`/cart/update/${purchaseId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({
                    purchase_id: purchaseId,
                    quantity: input.value,
                }),
            })

        }

        function handleDebouncedChange(input) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                processQuantity(input, "debounced");
            }, 500);
        }

        function handleImmediateChange(input) {
            processQuantity(input, "immediate");
        }

        document.querySelectorAll(".pro-qty-2").forEach(function (wrapper) {
            const input = wrapper.querySelector("input");
            const decBtn = wrapper.querySelector(".dec");
            const incBtn = wrapper.querySelector(".inc");

            incBtn?.addEventListener("click", function () {
                handleDebouncedChange(input);
            });

            decBtn?.addEventListener("click", function () {
                handleDebouncedChange(input);
            });

            let skipBlur = false;

            input.addEventListener("keydown", function (e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    skipBlur = true;
                    handleImmediateChange(input);
                    input.blur();
                    setTimeout(() => skipBlur = false, 0);
                }
            });

            input.addEventListener("blur", function () {
                if (!skipBlur) {
                    handleImmediateChange(input);
                }
            });
        });
    });
</script>

