<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where($request->condition,'like','%'.$request->search.'%')->latest('id')->paginate(5);

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
       $product =  Product::create($request->except('usage_id'));

        $product->usages()->sync($request->usage_id);

        return response()->json("Registrado Correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product['supplier'] = $product->supplier->name;
        $product['laboratory'] = $product->laboratory->name;
        $product['presentation'] = $product->presentation->name;
        $product['location'] = $product->location->name;
        $product['type'] = $product->type->name;
        $product['usages'] = $product->usages;

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        Log::info($request);

        $product->update($request->except('usage_id','supplier','laboratory','location','type','usages','presentation'));

        $product->usages()->sync($request->usage_id);

        return response()->json("Actualizado Correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json("Eliminado Correctamente");
    }
}
