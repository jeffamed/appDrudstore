<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaboratoryRequest;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $laboratories = Laboratory::where($request->condition,'like','%'.$request->search.'%')->latest('id')->paginate(5);
        return response()->json($laboratories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaboratoryRequest $request)
    {
        Laboratory::create($request->toArray());

        return response()->json('Registrado Exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratory $laboratory)
    {
        return response()->json($laboratory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(LaboratoryRequest $request, Laboratory $laboratory)
    {
        $laboratory->update($request->toArray());

        return response()->json("Actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();

        return response()->json('Eliminado correctamente');
    }
}
