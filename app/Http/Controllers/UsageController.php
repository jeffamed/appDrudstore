<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsageRequest;
use App\Models\Usage;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usages = Usage::where('description','like','%'.$request->search.'%')->latest('id')->paginate(6);
        return response()->json($usages);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsageRequest $request)
    {
        Usage::create($request->validated());

        return response()->json('Registrado Exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function show(Usage $usage)
    {
        return response()->json($usage);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function update(UsageRequest $request, Usage $usage)
    {
        $usage->update($request->validated());
        return response()->json("Actualizada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usage $usage)
    {
        $usage->delete();

        return response()->json("Eliminado correctamente");
    }

    public function getAll()
    {
        $usages = Usage::latest('id')->get();
        return response()->json($usages);
    }
}
