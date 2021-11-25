<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $request['user_id'] = 1; //(user login in the future)
        $order = Order::create($request->except('details'));

        if ($order){
            foreach ($request->details as $detail){
                $dOrder = new OrderDetails();
                $dOrder->order_id = $order->id;
                $dOrder->product_id = $detail['product_id'];
                $dOrder->orderQty = $detail['orderQty'];
                $dOrder->unitPrice = $detail['unitPrice'];
                $dOrder->discount = $detail['discount'];
                $dOrder->total = (($detail['orderQty'] * $detail['unitPrice']) - $detail['discount']);
                $dOrder->save();
            }
        }

        return response()->json('Registrado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json('Eliminado Correctamente');
    }
}
