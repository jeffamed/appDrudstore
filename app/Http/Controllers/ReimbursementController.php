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
            $suppliers = Supplier::where('name', 'like', '%'.$request->search.'%')->pluck('id');
            $reimbursements = Reimbursement::with('supplier', 'order')->whereIn('supplier_id', $suppliers)->latest('id')->paginate(6);
        }
        else{
            $reimbursements = Reimbursement::with('supplier', 'order')->latest('id')->paginate(6);
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
        $details = $reimbursement->details;
        foreach ($details as $detail){
            $detail->product;
        }

        $data = collect([
            'supplier' => $reimbursement->supplier->name,
            'ruc' => $reimbursement->supplier->ruc,
            'phone' => $reimbursement->supplier->phone,
            'address' => $reimbursement->supplier->address,
            'id' => $reimbursement->id,
            'total' => $reimbursement->total_format,
            'status' => $reimbursement->status,
            'created' => $reimbursement->created_at,
            'observation' => $reimbursement->observation,
            'order' => $reimbursement->order_id,
            'details' => $details,
        ]);

        return response()->json($data, 200);
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
