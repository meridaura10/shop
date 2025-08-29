<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Purchase;
use App\Services\Payment\LiqPay\LiqPayPaymentService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Action;

class Checkout extends Action
{
    public function __construct(
        protected LiqPayPaymentService $liqPayPaymentService
    ) {

    }

    public function handle(array $data): Order
    {
        $order = null;

        DB::transaction(function () use ($data, &$order) {
            $order = cart()->checkout($data);

            if (config('payments.online')) {
                $payment = $this->liqPayPaymentService->createPayment($order, $order->amount);
                $this->liqPayPaymentService->pay($payment);
            }
        });

        return $order;
    }
}
