<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Traits\Loggable;

class ProductController extends Controller
{
    use Loggable;

//     public function __construct()
//     {
//  //       $this->middleware('auth');
//         $this->middleware('role:admin,editor')->only(['store', 'update', 'destroy']);
//     }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;
        $search = $request->get('search');

        $paginatedProducts = Product::paginateProducts($page, $perPage, $search);

        $this->logCrudAction('viewed', 'Products list', 'page: '. $page. ' search: '.$search );

        if ($request->ajax()) {
            return response()->json([
                'table' => view('products.table', ['products' => $paginatedProducts['data']])->render(),
                'pagination' => view('products.pagination', ['paginator' => $paginatedProducts])->render(),
            ]);
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
        $this->logCrudAction('created', 'Product', $product['id']);

        if ($request->ajax()) {
            return response()->json($product);
        }

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $this->logCrudAction('show', 'Product', $id);
        $product = Product::getProduct($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado para mostrar'], 404);
        }

        return response()->json($product);
    }

    public function edit($id)
    {
        $product = Product::getProduct($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Producto no encontrado para editar.');
        }

        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::updateProduct($id, $request->validated());
        $this->logCrudAction('updated', 'Product ', $id);

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
        $this->logCrudAction('deleted', 'Product ', $id);

        return response()->json(['success' => 'Producto eliminado exitosamente.']);
    }

}