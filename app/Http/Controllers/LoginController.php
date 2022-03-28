<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /*public function login(Request $request)
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

    }*/

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($request->ajax() || $request->wantsJson()) {
            $user = $this->guard(config('sanctum.guard', 'web'))->user();
            $permissions = [];
            foreach ($user->rol->permissions as $permission){
                $permissions[] = $permission->name;
            }
            $user->permissions = $permissions;
            $user->token = $request->user()->createToken('tokens')->plainTextToken;
            return response()->json($user, 200);
        }
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    public function verified(User $user)
    {
        $permissions = [];
        foreach ($user->rol->permissions as $permission){
            $permissions[] = $permission->name;
        }
        $user->permissions = $permissions;
        return $user->permissions;
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json('login');
    }
}
