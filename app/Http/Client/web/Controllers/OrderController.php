<?php

namespace App\Http\Client\web\Controllers;

use App\Actions\Checkout;
use App\Http\Admin\Requests\CheckoutRequest;
use App\Http\Controllers\Controller;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('client.orders.checkout');
    }

    public function checkout(CheckoutRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->transformAddress($data, $request);

        $url = Checkout::run($data)->payment?->page_url ?? route('home');

        return redirect($url);
    }

    public function transformAddress(array &$data, Request $request): string
    {
        $ids = array_filter([
            $request->input('area_id'),
            $request->input('region_id'),
            $request->input('city_id'),
            $request->input('city_region_id'),
        ]);

        $settlements = Settlement::whereIn('id', $ids)
            ->orderByRaw("FIELD(id, " . implode(',', $ids) . ")")
            ->pluck('name')
            ->filter();

        $data['address'] = $settlements->implode(', ');

        return $data['address'];
    }
}
