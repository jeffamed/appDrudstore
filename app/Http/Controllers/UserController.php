<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where($request->condition,'like','%'.$request->search.'%')->latest('id')->paginate(5);
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->document = $request->document;
        $user->name     = $request->name;
        $user->last_name= $request->last_name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->address  = $request->address;
        $user->phone    = $request->phone;
        $user->save();

        return response()->json('Registrado Existosamente', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->document = $request->document;
        $user->name     = $request->name;
        $user->last_name= $request->last_name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->address  = $request->address;
        $user->phone    = $request->phone;
        $user->save();

        return response()->json('Actualizado Correctamente', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json('Eliminado Existosamente');
    }

}
