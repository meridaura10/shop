<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Requests\VariableRequest;
use Fomvasss\Variable\Facade as VariableFacade;
use Fomvasss\Variable\Models\Variable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VariableController
{
    public function index(): View
    {
        $variables = Variable::all();

        $l =$variables->last();

        return view('admin.variables.index', compact('variables'));
    }

    public function create(): View
    {
        return view('admin.variables.create');
    }

    public function destroy(Variable $variable): RedirectResponse
    {
        $variable->delete();

        return redirect()->route('admin.variables.index');
    }

    public function store(VariableRequest $request): RedirectResponse
    {
        VariableFacade::save(...$request->getData());

        return redirect()->route('admin.variables.index');
    }

    public function update(Request $request, Variable $variable): RedirectResponse
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            VariableFacade::saveArray($key, $value);
        }

        return redirect()->back();
    }
}
