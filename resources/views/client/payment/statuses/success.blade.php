<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-lg text-center p-5">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="text-success" width="80" height="80" fill="currentColor"
                     viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75
                                0 0 0 1.07.02l3.992-3.99a.75.75 0 1 0-1.06-1.06L7.5
                                9.439 6.07 8.01a.75.75 0 0 0-1.08 1.04l2
                                2z"/>
                </svg>
            </div>
            <h3 class="mb-3">Оплата успішна ✅</h3>
            <p class="text-muted mb-4">
                Дякуємо за Ваше замовлення! Оплата пройшла успішно.
            </p>

            @if($payment->model instanceof \App\Models\Order)
                <a href="{{ route('my.profile', $payment->model->id) }}" class="btn btn-success px-4 py-2">
                    Переглянути замовлення
                </a>
            @endif
        </div>
    </div>
</div>
