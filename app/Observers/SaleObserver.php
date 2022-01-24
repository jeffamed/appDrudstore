<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function created(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "updated" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function updated(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "deleted" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function deleted(Sale $sale)
    {
        $details = SaleDetails::where('sale_id', $sale->id)->get();

        if($details){
            foreach ($details as $detail){
                $product = Product::find($detail->product_id);
                $product->stock = $product->stock + $detail->orderQty;
                $product->box_stock = $product->stock / $product->unit_box;
                $product->save();
            }
        }
    }

    /**
     * Handle the Sale "restored" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function restored(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function forceDeleted(Sale $sale)
    {
        //
    }
}
