<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Rol::create($request->except('permission_id'));

        $role->permissions()->sync($request->permission_id);

        return response()->json("Registrado Correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $role)
    {
        $permissions = DB::table('permission_rol')->select('permission_id')->where('rol_id', $role->id)->get();
        $id = [];
        foreach ($permissions as $permission){
            $id[] = $permission->permission_id;
        }
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $role)
    {
        $role->update($request->except('permission_id'));
        $role->permissions()->sync($request->permission_id);

        return response()->json("Actualizado Correctamente");
    }
}
