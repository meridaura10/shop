<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Requests\CharacteristicRequest;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Characteristic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CharacteristicController extends Controller
{
    public function store(CharacteristicRequest $request, Attribute $attribute): RedirectResponse
    {
        $attribute->characteristics()->create($request->validated());

        return redirect()->route('admin.attributes.edit',$attribute);
    }

    public function edit(Characteristic $characteristic): JsonResponse
    {
        $html = view('admin.characteristics.edit',compact('characteristic'))->render();

        return response()->json(compact('html'));
    }

    public function update(CharacteristicRequest $request, Characteristic $characteristic): RedirectResponse
    {
        $characteristic->update($request->validated());

        return redirect()->route('admin.attributes.edit', $characteristic->attribute_id);
    }

    public function destroy(Characteristic $characteristic): RedirectResponse
    {
        $attributeId = $characteristic->attribute_id;

        $characteristic->delete();

        return redirect()->route('admin.attributes.edit', $attributeId);
    }
}
