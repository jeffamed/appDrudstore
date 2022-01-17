<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Reimbursement;
use App\Models\ReimbursementDetails;

class ReimbursementObserver
{
    /**
     * Handle the Reimbursement "created" event.
     *
     * @param  \App\Models\Reimbursement  $reimbursement
     * @return void
     */
    public function created(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Handle the Reimbursement "updated" event.
     *
     * @param  \App\Models\Reimbursement  $reimbursement
     * @return void
     */
    public function updated(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Handle the Reimbursement "deleted" event.
     *
     * @param  \App\Models\Reimbursement  $reimbursement
     * @return void
     */
    public function deleted(Reimbursement $reimbursement)
    {
        $details = ReimbursementDetails::where('reimbursement_id', $reimbursement->id)->get();

        if($details){
            foreach ($details as $detail){
                $product = Product::find($detail->product_id);
                $product->stock = $product->stock + $detail->qty;
                $product->save();
            }
        }
    }

    /**
     * Handle the Reimbursement "restored" event.
     *
     * @param  \App\Models\Reimbursement  $reimbursement
     * @return void
     */
    public function restored(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Handle the Reimbursement "force deleted" event.
     *
     * @param  \App\Models\Reimbursement  $reimbursement
     * @return void
     */
    public function forceDeleted(Reimbursement $reimbursement)
    {
        //
    }
}
