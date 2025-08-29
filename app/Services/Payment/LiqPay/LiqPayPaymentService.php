<?php

namespace App\Services\Payment\LiqPay;


use App\Models\contracts\PaymentRelationInterface;
use App\Models\Payment;
use Illuminate\Http\Request;

class LiqPayPaymentService
{
    private LiqPayApiService $liqPayApiService;

    public function __construct()
    {
        $this->liqPayApiService = new LiqPayApiService;
    }

    public function pay(Payment $payment): string
    {
        try {
            $paymentUrl = $this->getPaymentUrl($payment);

            if (!$paymentUrl) {
                throw new \Exception('Failed to create payment URL');
            }

            return $paymentUrl;
        } catch (\Exception $e) {
            throw new \Exception('Failed to pay card: ' . $e->getMessage());
        }
    }

    private function getPaymentUrl(Payment $payment): string|false
    {
        $paymentUrl = $payment->payment_page_url;

        if (!$paymentUrl) {
            $paymentUrl = $this->createCheckoutUrl($payment);
        }

        return $paymentUrl;
    }

    public function createCheckoutUrl(Payment $payment): string|false
    {
        try {
            $data = $this->liqPayApiService->checkout($payment);

            $this->updatePayment($payment, [
                'page_url' => $data['url'],
                'expired_time' => $data['date'],
            ]);

            return $data['url'];
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function getStatus(Payment $payment): string
    {
        try {
            $status = $this->liqPayApiService->getStatus($payment);

            return $this->statusNormal($status->status);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function statusNormal(string $status): string
    {
        switch ($status) {
            case 'reversed':
            case 'error':
            case 'try_again':
            case 'failure':
                return Payment::STATUS_FAILED;
            case 'success':
                return Payment::STATUS_COMPLETED;
        }
    }

    public function response(Payment $payment): Payment
    {
        try {
            $payment->update([
                'status' => $this->getStatus($payment),
            ]);

            return $payment;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function callback(Request $request): Payment
    {
        $data = $request->input('data');

        $json = base64_decode($data);

        $payload = json_decode($json, true);

        $payment = Payment::query()->where('uuid', $payload['order_id'])->first();

        $payment->update(['status' => $this->statusNormal($payload['status'])]);

        return $payment;
    }

    public function createPayment(PaymentRelationInterface $model, int $amount): Payment
    {
        return $model->payment()->create([
            'system' => Payment::SYSTEM_LIQPAY,
            'amount' => $amount,
        ]);
    }

    public function updatePayment(Payment $payment, array $data): bool
    {
        return $payment->update([
            ...$data,
            'system' => Payment::SYSTEM_LIQPAY,
        ]);
    }
}
