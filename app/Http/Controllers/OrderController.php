<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->condition === 'supplier')
        {
            $suppliers = Supplier::where('name', 'like', '%'.$request->search.'%')->get();
            $ids = [];
            foreach ($suppliers as $supplier){ $ids[] = $supplier->id; }
            $orders = Order::with('user','supplier')->whereIn('supplier_id',$ids)->latest('id')->paginate(6);
        }
        elseif ($request->condition === 'user')
        {
            $users = User::where('name', 'like', '%'.$request->search.'%')->get();
            $ids = [];
            foreach ($users as $user){ $ids[] = $user->id; }
            $orders = Order::with('user','supplier')->whereIn('user_id',$ids)->latest('id')->paginate(6);
        }else{
            $orders = Order::with('user','supplier')->latest('id')->paginate(6);
        }

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
        $order = Order::create($request->except('details'));

        if ($order){
            foreach ($request->details as $detail){
                $dOrder = new OrderDetails();
                $dOrder->order_id = $order->id;
                $dOrder->product_id = $detail['product_id'];
                $dOrder->orderQty = $detail['orderQty'];
                $dOrder->unitPrice = $detail['unitPrice'];
                $dOrder->discount = $detail['discount'];
                $dOrder->expire_at = $detail['expire_at'];
                $dOrder->priceSuggest = $detail['priceSuggest'];
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
        $order->details = $order->details;
        $details = $order->details;
        foreach ($details as $detail){
            $detail->product;
        }
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

    public function reportOrder()
    {
        DB::statement("SET lc_time_names = 'es_ES'");
        $orders = DB::table('orders')
            ->selectRaw('MONTHNAME(orders.created_at) as mes, sum(subtotal) as subTotal, sum(discount) as Descuento, sum(total) as Total')
            ->whereYear('created_at',now())
            ->groupByRaw('mes')
            ->orderByRaw('mes desc')
            ->get();
        $orders_total = DB::table('orders')
            ->selectRaw('sum(subtotal) as subTotal, sum(discount) as Descuento, sum(total) as Total')
            ->whereYear('created_at',now())
            ->get();
        $pdf = \PDF::loadView('report.orders', compact('orders','orders_total'))->setPaper('letter', 'portrait');
        return $pdf->download('compras_segun_meses.pdf');
    }

    public function findSupplier($supplier)
    {
        $orders = DB::table('orders')
            ->join('suppliers', 'orders.supplier_id','=', 'suppliers.id')
            //->where('numOrder','like',$customer.'%')
            ->where('suppliers.id', $supplier)
            ->latest('orders.id')->pluck('orders.total','orders.id')
            ->take(50);

        return response()->json($orders);
    }
}
