<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Generaloptions;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $hideNoActives = Generaloptions::get('hide_no_actives', '0');
        $hideNoStock = Generaloptions::get('hide_no_existences', '0');

        $products = Product::when($hideNoActives == 1, fn($query) => $query->where('active', true))
            ->when($hideNoStock == 1, fn($query) => $query->where('units', '>', 0))
            ->paginate(12);

        return view('product.index', [
            'products' => $products,
            //'title' => 'Productos de nuestra tienda',
        ]);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('products.index');
    }

    public function create(Request $request): View
    {
        return view('product.create');
    }

    public function show(Request $request, Product $product): View
    {
        $randoms = [];
        $impath = "";
        for ($i = 0; $i < 4; $i++) {
            $randoms[] = Product::find(rand($i, Product::count()));
        }
        foreach ($product->imageproducts as $imgPal) {
            if ($imgPal->img_position === 1) {
                $impath = $imgPal->img_paht;
            }
        }
        return view('product.show', [
            'product' => $product,
            'randoms' => $randoms,
            'impath' => $impath,
            'esSingleProduct' => true,
        ]);
    }

    public function edit(Request $request, Product $product): View
    {
        return view('product.edit', [
            'product' => $product,
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('products.index');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }

    public function buyit(Request $request, Product $product): View
    {
        return view('product.buyit', [
            'product' => $product,
        ]);
    }
}
