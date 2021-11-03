<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresentationRequest;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::info("variable search: ".$request->search);
        $presentations = Presentation::where('name','like','%'.$request->search.'%')->latest('id')->paginate(5);
        return response()->json($presentations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PresentationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request)
    {
        Presentation::create($request->validated());

        return response()->json("Registrado Exitosamente", 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation)
    {
        return response()->json($presentation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PresentationRequest  $request
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, Presentation $presentation)
    {
        $presentation->update($request->validated());

        return response()->json($presentation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presentation $presentation)
    {
        $presentation->delete();

        return response()->json('Eliminado existosamente', 200);
    }
}
