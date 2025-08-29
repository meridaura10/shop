<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Requests\AttributeRequest;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttributeController extends Controller
{
    public function index(): View
    {
        $attributes = Attribute::query()->withCount(['characteristics', 'categories'])->paginate(15);

        return view('admin.attributes.index', compact('attributes'));
    }

    public function create(): View
    {
        return view('admin.attributes.create');
    }

    public function store(AttributeRequest $request): RedirectResponse
    {
        $categoryIds = $request->get('categories', []);

        $attribute = Attribute::create($request->validated());

        $attribute->categories()->attach($categoryIds);

        return redirect()->route('admin.attributes.edit', $attribute);
    }

    public function edit(Attribute $attribute): View
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(AttributeRequest $request, Attribute $attribute): RedirectResponse
    {
        $categoryIds = $request->get('categories', []);

        $attribute->update($request->validated());

        $attribute->categories()->sync($categoryIds);

        return redirect()->route('admin.attributes.edit', $attribute);
    }

    public function destroy(Attribute $attribute): RedirectResponse
    {
        $attribute->delete();

        return redirect()->route('admin.attributes.index');
    }
}
