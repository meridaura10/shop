<?php

namespace App\Http\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistributionRequest;
use App\Models\Distribution;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DistributionController extends Controller
{
    public function index(): View
    {
        $distributions = Distribution::all();

        return view('admin.distributions.index', compact('distributions'));
    }

    public function store(DistributionRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $sendAt = Carbon::parse($data['datetime'], 'Europe/Kyiv')->addSecond();

        Distribution::create([
            'message' => $data['message'],
            'send_at' => $sendAt,
        ]);

        return back();
    }

    public function put(Request $request, Distribution $distribution): JsonResponse
    {
        if ($request->name === 'date') {
            $current = \Carbon\Carbon::parse($distribution->send_at);

            $newDateTime = \Carbon\Carbon::parse($request->value . ' ' . $current->format('H:i:s'));

            $distribution->update([
                'send_at' => $newDateTime
            ]);
        }

        if ($request->name === 'time') {
            $current = \Carbon\Carbon::parse($distribution->send_at);

            $newDateTime = \Carbon\Carbon::parse($current->format('Y-m-d') . ' ' . $request->value);

            $distribution->update([
                'send_at' => $newDateTime->toString()
            ]);
        }

        if ($request->name === 'message' || $request->name === 'status') {
            $distribution->update([$request->name => $request->value]);
        }

        return response()
            ->json(['message' => trans('lte::alerts.update.success')], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }

    public function destroy(Distribution $distribution): RedirectResponse
    {
        $distribution->delete();

        return back();
    }
}
