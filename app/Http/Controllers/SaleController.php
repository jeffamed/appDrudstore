<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return response()->json($sale->id);
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

    public function invoice(Sale $sale, $type = 'download')
    {
        $customer = Customer::find($sale->customer_id);

        $details = SaleDetails::with('product')->where('sale_id', $sale->id)->get();

        $pdf = \PDF::loadView('report.invoice', compact('sale','customer','details'))->setPaper('letter', 'landscape');
        return $type === 'download' ? $pdf->download('factura.pdf') : $pdf->stream();
    }

    public function reportSale()
    {
        DB::statement("SET lc_time_names = 'es_ES'");
        $sales = DB::table('sales')
            ->selectRaw('MONTHNAME(sales.created_at) as mes, sum(subtotal) as subTotal, sum(discount) as Descuento, sum(total) as Total')
            ->whereYear('created_at',now())
            ->groupByRaw('mes')
            ->orderByRaw('mes DESC')
            ->get();
        $sales_total = DB::table('sales')
            ->selectRaw('sum(subtotal) as subTotal, sum(discount) as Descuento, sum(total) as Total')
            ->whereYear('created_at',now())
            ->get();
        $pdf = \PDF::loadView('report.sales', compact('sales','sales_total'))->setPaper('letter', 'portrait');
        return $pdf->download('ventas_segun_meses.pdf');
    }
}
