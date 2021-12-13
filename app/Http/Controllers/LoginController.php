<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

       if(Auth::attempt($credentials))
       {
           $user = Auth::user();
           $permissions = [];
           foreach ($user->rol->permissions as $permission){
               $permissions[] = $permission->name;
           }
           $user->permissions = $permissions;
            return response()->json($user, 200);
       }
       throw ValidationException::withMessages([
           'email' => ['Las credenciales registradas anteriormente no coiniciden']
       ]);

    }

    public function verified()
    {
        $user = Auth::user() ?? 'unauthorization';
        return response()->json($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json('login');
    }
}
