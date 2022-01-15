<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ReimbursementDetails;

class ReimbursementDetailsObserver
{
    /**
     * Handle the ReimbursementDetails "created" event.
     *
     * @param  \App\Models\ReimbursementDetails  $reimbursementDetails
     * @return void
     */
    public function created(ReimbursementDetails $reimbursementDetails)
    {
        $product = Product::find($reimbursementDetails->product_id);
        $product->stock = $product->stock - $reimbursementDetails->qty;
        $product->save();
    }

    /**
     * Handle the ReimbursementDetails "updated" event.
     *
     * @param  \App\Models\ReimbursementDetails  $reimbursementDetails
     * @return void
     */
    public function updated(ReimbursementDetails $reimbursementDetails)
    {
        //
    }

    /**
     * Handle the ReimbursementDetails "deleted" event.
     *
     * @param  \App\Models\ReimbursementDetails  $reimbursementDetails
     * @return void
     */
    public function deleted(ReimbursementDetails $reimbursementDetails)
    {
        //
    }

    /**
     * Handle the ReimbursementDetails "restored" event.
     *
     * @param  \App\Models\ReimbursementDetails  $reimbursementDetails
     * @return void
     */
    public function restored(ReimbursementDetails $reimbursementDetails)
    {
        //
    }

    /**
     * Handle the ReimbursementDetails "force deleted" event.
     *
     * @param  \App\Models\ReimbursementDetails  $reimbursementDetails
     * @return void
     */
    public function forceDeleted(ReimbursementDetails $reimbursementDetails)
    {
        //
    }
}
