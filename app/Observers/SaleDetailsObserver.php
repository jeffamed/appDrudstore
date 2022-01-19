<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\SaleDetails;

class SaleDetailsObserver
{
    /**
     * Handle the SaleDetails "created" event.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return void
     */
    public function created(SaleDetails $saleDetails)
    {
        $product = Product::find($saleDetails->product_id);
        $product->box_stock = $product->box_stock - $saleDetails->orderQty;
        $product->stock = $product->box_stock * $product->unit_box;
        $product->save();
    }

    /**
     * Handle the SaleDetails "updated" event.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return void
     */
    public function updated(SaleDetails $saleDetails)
    {
        //
    }

    /**
     * Handle the SaleDetails "deleted" event.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return void
     */
    public function deleted(SaleDetails $saleDetails)
    {
        //
    }

    /**
     * Handle the SaleDetails "restored" event.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return void
     */
    public function restored(SaleDetails $saleDetails)
    {
        //
    }

    /**
     * Handle the SaleDetails "force deleted" event.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return void
     */
    public function forceDeleted(SaleDetails $saleDetails)
    {
        //
    }
}
