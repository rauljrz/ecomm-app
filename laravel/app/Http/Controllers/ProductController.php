<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;

        $paginatedProducts = Product::paginateProducts($page, $perPage);

        if ($request->ajax()) {
            return view('products.table', ['products' => $paginatedProducts['data']])->render();
        }

        return view('products.index', ['products' => $paginatedProducts]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $product = Product::createProduct($request->validated());

        if ($request->ajax()) {
            return response()->json($product);
        }

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $product = Product::getProduct($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        return response()->json($product);
    }

    public function edit($id)
    {
        $product = Product::getProduct($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Producto no encontrado.');
        }

        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::updateProduct($id, $request->validated());

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        if ($request->ajax()) {
            return response()->json($product);
        }

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Product::deleteProduct($id);

        return response()->json(['success' => 'Producto eliminado exitosamente.']);
    }

    public function search(Request $request)
    {
        $term = $request->get('search');
        $products = Product::searchProducts($term);

        if ($request->ajax()) {
            return view('products.table', compact('products'))->render();
        }

        return view('products.index', compact('products'));
    }
}