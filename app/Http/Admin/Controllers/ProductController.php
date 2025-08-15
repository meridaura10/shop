<?php

namespace App\Http\Admin\Controllers;

use App\Actions\Products\CreateNewProduct;
use App\Actions\Products\UpdateNewProduct;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportDataRequest;
use App\Http\Requests\ProductRequest;
use App\Imports\ProductsImport;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Term;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Product::class);

        $products = Product::query()
            ->filter($request->all())
            ->with('brand','media', 'category', 'characteristics.attribute')
            ->paginate();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $this->authorize('create', Product::class);

        return view('admin.products.create');
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();

        $product = CreateNewProduct::run([
            'product' => $request->getData(),
            'categories' => $data['categories'] ?? [],
        ]);

        $product->mediaManage($request);

        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product): View
    {
        $this->authorize('update', $product);

        $attributes = Attribute::query()
            ->whereHas('categories', function ($query) use ($product) {
                $query->whereIn('terms.id', $product->categories->pluck('id'))->orderBy('terms.weight');
            })
            ->with('characteristics')
            ->get();

        return view('admin.products.edit', compact('product', 'attributes'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);

        $data = $request->validated();

        $product = UpdateNewProduct::run($product, [
            'product' => $request->getData(),
            'categories' => $data['categories'] ?? [],
            'characteristics' => $data['characteristics'] ?? [],
        ]);

        $product->mediaManage($request);

        return redirect()->route('admin.products.edit', $product);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('admin.products.index');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new ProductsExport(), "products.xlsx");
    }

    public function import(ImportDataRequest $request): RedirectResponse
    {
        Excel::import(new ProductsImport(), $request->file('file'));

        return back();
    }
}
