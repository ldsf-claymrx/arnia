<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function authLogin(Request $request) {
        
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard');

        } else {
            throw ValidationException::withMessages([
                'Notificacion' => '¡Las credenciales son incorrectas!'
            ]);
            
        }
    }

    public function authLogout() {
        Auth::logout();
        return redirect('/');
    }
}
