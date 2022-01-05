<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tmp_TopProd = [];
        $tmp_TotalProd = [];
        $tmp_month = [];
        $tmp_TotalMonth = [];
        $today = Carbon::now();
        $startWeek = $today->startOfWeek()->format('Y-m-d');
        $endWeek = $today->endOfWeek()->format('Y-m-d');

        $day = DB::table('sales')->whereDate('created_at',now()->format('Y-m-d'))->count();
        $order = DB::table('orders')->whereDate('created_at',now()->format('Y-m-d'))->count();
        $money = DB::table('sales')->whereDate('created_at',now()->format('Y-m-d'))->sum('total');
        $week = DB::table('sales')->whereBetween('created_at',[$startWeek, $endWeek])->count();
        $top_product = DB::table('sale_details')
                    ->join('products','sale_details.product_id','=', 'products.id')
                    ->select('products.name as product', DB::raw('sum(orderQty) as total'))
                    ->groupBy('product_id')
                    ->orderByRaw('sum(orderQty) desc')
                    ->limit(10)
                    ->get();
        foreach ($top_product as $product){
            $tmp_TopProd[] = $product->product;
            $tmp_TotalProd[] = $product->total;
        }

        DB::statement("SET lc_time_names = 'es_ES'");
        $sales = DB::table('sales')
                    ->selectRaw('MONTHNAME(sales.created_at) as mes, count(id) as total')
                    ->whereYear('created_at',now())
                    ->groupByRaw('mes')
                    ->orderByRaw('mes desc')
                    ->get();

        foreach ($sales as $sale){
            $tmp_month[] = $sale->mes;
            $tmp_TotalMonth[] = $sale->total;
        }

        $data = collect([
            'top'=>['product'=>$tmp_TopProd,'total'=>$tmp_TotalProd],
            'sales' => ['month' => $tmp_month, 'total' => $tmp_TotalMonth],
            'day' => $day,
            'week' => $week,
            'money' => $money,
            'order' => $order
            ]);

        return response()->json($data);
    }
}
