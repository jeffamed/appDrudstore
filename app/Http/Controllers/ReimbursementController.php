<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReimbursementRequest;
use App\Models\Reimbursement;
use App\Models\ReimbursementDetails;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReimbursementController extends Controller
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
            $reimbursements = Reimbursement::with('supplier')->whereIn('supplier_id',$ids)->latest('id')->paginate(6);
        }
        else{
            $reimbursements = Reimbursement::with('supplier')->latest('id')->paginate(6);
        }

        return response()->json($reimbursements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReimbursementRequest $request)
    {
        $reimbursement = Reimbursement::create($request->validated());
        foreach ($request->products as $product){
            if ($product['reimbursement'] > 0){
                $details = new ReimbursementDetails();
                $details->reimbursement_id = $reimbursement->id;
                $details->product_id = $product['id'];
                $details->qty = $product['reimbursement'];
                $details->price = $product['unitPrice'];
                $details->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function show(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reimbursement $reimbursement)
    {
        $reimbursement->delete();

        return response()->json('Eliminado Correctamente');
    }
}
