<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $products = Product::where($request->condition,'like','%'.$request->search.'%')->latest('id')->paginate($request->pagination);

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
       $product = Product::create($request->except('usage_id'));

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
        $product->laboratorio = $product->laboratory->name;
        $product->presentacion = $product->presentation->name;
        $product->ubicacion = $product->location->name;
        $product->tipo = $product->type->name;
        $product->proveedor = $product->supplier->name;
        $product->usage_id = $product->usages->map(function ($item, $key){
            return $item->id;
        });

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
        $product->update($request->except('usage_id','laboratorio','ubicacion','tipo','presentacion','proveedor', 'usages'));

        if (count($request->usage_id) > 0){
            $product->usages()->sync($request->usage_id);
        }

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

    public function search(Request $request)
    {
          if($request->condition === 'code'){
              $products = Product::where('code','like','%'.$request->search.'%')->first();
              if ($products){
                  $products->presentacion = $products->presentation->name;
              }
          }else{
              $products = Product::with('presentation')->select()->addSelect(DB::raw('0 as costOrder, 0 as qtyOrder, 0 as discountOrder'))->where('name','like','%'.$request->search.'%')->take(25)->get();
          }

          return response()->json($products);
    }
}
