<div>
    <h5 class="fw-semibold mb-3">Історія замовлень</h5>
    <div class="row g-3">
        @foreach($user->orders as $order)
            <div class="col-md-6 mt-2">
                <div class="bw-item p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-bold mb-1">Замовлення #{{ $order->id }}</div>
                            <div class="text-muted small">Дата: {{ $order->created_at }}</div>
                            <div class="text-muted small">Сума: {{ $order->amount }} грн</div>
                        </div>
                        <a href="{{ route('my.orders.show', $order) }}" class="btn-bw-outline btn-bw-sm">Деталі</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
