<?php

namespace App\Http\Client\web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Settlement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuggestController extends Controller
{
    public function settlements(Request $request, string $type): array
    {
        $search = $request->input('q');

        $settlements = Settlement::query()
            ->filter(array_merge($request->all(), ['type' => $type]))
            ->where('name', 'like', "%{$search}%")
            ->select('id', 'name as text')
            ->limit(5)
            ->get();

        return ['results' => $settlements->toArray()];
    }
}
