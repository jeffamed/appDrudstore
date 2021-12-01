<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->condition === 'customer')
        {
            $suppliers = Customer::where('name', 'like', '%'.$request->search.'%')->get();
            $ids = [];
            foreach ($suppliers as $supplier){ $ids[] = $supplier->id; }
            $sales = Sale::with('user','customer')->whereIn('customer_id',$ids)->latest('id')->paginate(6);
        }
        elseif ($request->condition === 'user')
        {
            $users = User::where('name', 'like', '%'.$request->search.'%')->get();
            $ids = [];
            foreach ($users as $user){ $ids[] = $user->id; }
            $sales = Sale::with('user','customer')->whereIn('user_id',$ids)->latest('id')->paginate(6);
        }
        else{
            $sales = Sale::with('user','customer')->latest('id')->paginate(6);
        }

        return response()->json($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $request['user_id'] = 1; //(user login in the future)
        $sale = Sale::create($request->except('details'));

        if ($sale){
            foreach ($request->details as $detail){
                $dSales = new SaleDetails();
                $dSales->sale_id = $sale->id;
                $dSales->product_id = $detail['product_id'];
                $dSales->orderQty = $detail['orderQty'];
                $dSales->unitPrice = $detail['unitPrice'];
                $dSales->discount = $detail['discount'];
                $dSales->total = (($detail['orderQty'] * $detail['unitPrice']) - $detail['discount']);
                $dSales->save();
            }
        }

        return response()->json('Registrado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $details=$sale->details;
        foreach ($details as $detail){
            $detail->product;
        }
        return response()->json($sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->json("Eliminado Correctamente");
    }
}
