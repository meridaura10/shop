<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\Payment\LiqPay\LiqPayPaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        protected LiqPayPaymentService $liqPayPaymentService
    ) {

    }

    public function response(Payment $payment): JsonResponse|View
    {
        try {
            $this->liqPayPaymentService->response($payment);

            return view('client.payment.response', compact('payment'));
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['status' => 'error'], 500);
        }
    }

    public function callback(Request $request): JsonResponse
    {
        try {
            $this->liqPayPaymentService->callback($request);

            return response()->json(['status' => 'ok'], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['status' => 'error'], 500);
        }
    }
}
