@extends('client.layouts.app')

@section('content')
    <section class="about spad">
        <div class="container">
            @if($payment->status === \App\Models\Payment::STATUS_COMPLETED)
                @include('client.payment.statuses.success', compact('payment'))
            @endif

            @if($payment->status === \App\Models\Payment::STATUS_FAILED)
                @include('client.payment.statuses.error', compact('payment'))
            @endif
        </div>
    </section>
@endsection
