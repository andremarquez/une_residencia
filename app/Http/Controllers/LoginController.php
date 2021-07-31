<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;



class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // solo se permite hacer login de usuarios activos
        // $credentials['status'] = 1; 

        // validar credenciales de usuario
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if($user->status != 1) {
                return back()->withErrors([
                    'email' => 'Su usuario esta inactivo',
                ]);
            }
            
            $request->session()->regenerate();

            // Retrieve the currently authenticated user...


                switch($user->role_id){
                    case Role::ROL_ADMIN:
                        return redirect()->route('admin.dashboard');
                    case Role::ROL_TESORERO:
                        return redirect()->route('tesorero.dashboard');
                     case Role::ROL_PROPIETARIO:
                        return redirect()->route('propietario.dashboard');
                    default:
                    // usuarios con rol no definido
                    return  redirect()->route('inicio');
                }
         

        }

        return back()->withErrors([
            'email' => 'Las credenciales suministradas son invalidas',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}