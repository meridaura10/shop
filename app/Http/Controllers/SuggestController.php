<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuggestController extends Controller
{
    public function products(Request $request): array
    {
        $search = $request->input('q');

        $products = Product::query()
            ->where('name', 'like', "%{$search}%")
            ->select('id', 'name as text')
            ->limit(5)
            ->get();


        return ['results' => $products->toArray()];
    }

    public function roles(Request $request): array
    {
        $search = $request->input('q');

        $roles = Role::query()
            ->where('name', 'like', "%{$search}%")
            ->select('id', 'name as text')
            ->limit(5)
            ->get();

        if($request->input('is_default')){
            $roles->prepend(
                ['id' => 0, 'text' => 'Усі']
            );
        }


        return ['results' => $roles->toArray()];
    }

    public function permissions(Request $request): array
    {
        $search = $request->input('q');

        $permissions = Permission::query()
            ->where('name', 'like', "%{$search}%")
            ->select('id', 'name as text')
            ->limit(5)
            ->get();


        return ['results' => $permissions->toArray()];
    }

    public function users(Request $request): array
    {
        $search = $request->input('q');

        $users = User::query()
            ->where('email', 'like', "%{$search}%")
            ->select('id', 'email as text')
            ->limit(5)
            ->get();


        return ['results' => $users->toArray()];
    }

    public function terms(Request $request,string $vocabulary): array
    {
        $search = $request->input('q');
        $exception = $request->input('exception_id');

        $terms = Term::whereVocabulary($vocabulary)
            ->whereNot('id', $exception)
            ->where('name', 'like', "%{$search}%")
            ->select('id', 'name as text')
            ->limit(5)
            ->get();

        if($exception || $request->input('is_default')){
            $terms->prepend(
                ['id' => 0, 'text' => 'немає']
            );
        }


        return ['results' => $terms->toArray()];
    }
}
