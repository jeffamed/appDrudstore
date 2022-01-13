<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

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
            $reimbursements = Reimbursement::with('user', 'supplier')->whereIn('supplier_id',$ids)->latest('id')->paginate(6);
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
    public function store(Request $request)
    {

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
