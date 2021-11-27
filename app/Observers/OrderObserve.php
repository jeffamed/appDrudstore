<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;

class OrderObserve
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        $details = OrderDetails::where('order_id', $order->id)->get();

        if($details){
            foreach ($details as $detail){
                $product = Product::find($detail->product_id);
                $product->cost = $product->costPrev;
                $product->stock = $product->stock - $detail->orderQty;
                $product->save();
            }
        }
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {

    }
}
