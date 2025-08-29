@extends('client.layouts.app')

@section('content')
    <section class="py-5">
        <div class="container-fluid px-4">
            <div class="card shadow-sm border-0 rounded-lg mb-4">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-semi-bold">Замовлення #{{ $order->id }}</h5>
                    <span class="badge bg-{{ $order->status_color }}">
                    {{ $order->status_label }}
                </span>
                </div>
                <div class="card-body p-4">
                    {{-- Інформація про замовлення --}}
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Інформація</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Клієнт:</strong> {{ $order->customer['first_name'] }} {{ $order->customer['last_name'] }}</p>
                                <p><strong>Email:</strong> {{ $order->customer['email'] }}</p>
                                <p><strong>Телефон:</strong> {{ $order->customer['phone'] }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Тип:</strong> {{ $order->type_label }}</p>
                                <p><strong>Створено:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                                <p><strong>Оновлено:</strong> {{ $order->updated_at->format('d.m.Y H:i') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Місто доставки:</strong> {{ $order->address }}</p>
                                <p><strong>Сума:</strong> <span class="fw-bold">{{ number_format($order->amount, 2) }} ₴</span></p>
                                <p><strong>Статус:</strong> <span class="fw-bold">{{ \App\Models\Order::statusesList('name', 'key')[$order->status] }}</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Продукти --}}
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Товари</h6>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Назва</th>
                                    <th class="text-end">Ціна</th>
                                    <th class="text-end">К-сть</th>
                                    <th class="text-end">Сума</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->purchases as $i => $purchase)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $purchase->name }}</td>
                                        <td class="text-end">{{ number_format($purchase->price, 2) }} ₴</td>
                                        <td class="text-end">{{ $purchase->quantity }}</td>
                                        <td class="text-end">{{ number_format($purchase->amount, 2) }} ₴</td>
                                    </tr>
                                @endforeach
                                <tr class="table-light">
                                    <td colspan="4" class="text-end"><strong>Разом:</strong></td>
                                    <td class="text-end fw-bold">{{ number_format($order->amount, 2) }} ₴</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Оплата --}}
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Оплата</h6>
                        @if($order->payment)
                            <div class="p-3 bg-light rounded">
                                <p><strong>Сума:</strong> {{ number_format($order->payment->amount, 2) }} ₴</p>
                                <p><strong>Статус:</strong>
                                    <span class="badge bg-{{ $order->payment->status_color }}">
                                    {{ $order->payment->status_label }}
                                </span>
                                </p>
                                <p><strong>Дата:</strong> {{ $order->payment->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                        @else
                            <p class="text-muted">Оплату ще не здійснено</p>
                        @endif
                    </div>

                    {{-- Доставка --}}
                    <div>
                        <h6 class="text-muted mb-3">Доставка</h6>
                        <div class="p-3 bg-light rounded">
                            <p><strong>Адреса:</strong> {{ $order->address['city'] ?? '-' }}</p>
                            <p><strong>Статус:</strong> {{ $order->delivery_status_label ?? 'Не вказано' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
