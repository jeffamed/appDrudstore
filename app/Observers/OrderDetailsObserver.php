<?php

namespace App\Observers;

use App\Models\OrderDetails;
use App\Models\Product;

class OrderDetailsObserver
{
    /**
     * Handle the OrderDetails "created" event.
     *
     * @param  \App\Models\OrderDetails  $orderDetails
     * @return void
     */
    public function created(OrderDetails $orderDetails)
    {
        $product = Product::find($orderDetails->product_id);
        $product->box_stock = $product->box_stock + $orderDetails->orderQty;
        $product->stock = $product->box_stock * $product->unit_box;
        $product->expire_at = $orderDetails->expire_at;
        $product->save();
    }

    /**
     * Handle the OrderDetails "updated" event.
     *
     * @param  \App\Models\OrderDetails  $orderDetails
     * @return void
     */
    public function updated(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Handle the OrderDetails "deleted" event.
     *
     * @param  \App\Models\OrderDetails  $orderDetails
     * @return void
     */
    public function deleted(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Handle the OrderDetails "restored" event.
     *
     * @param  \App\Models\OrderDetails  $orderDetails
     * @return void
     */
    public function restored(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Handle the OrderDetails "force deleted" event.
     *
     * @param  \App\Models\OrderDetails  $orderDetails
     * @return void
     */
    public function forceDeleted(OrderDetails $orderDetails)
    {
        //
    }
}
