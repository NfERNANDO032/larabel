<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

 
            return redirect()->route('usuarios.index'); // 👈 redirige a la ruta deseada después del inicio de sesión exitoso
        }
 
        return back()->with('error', 'Credenciales incorrectas.')->withInput();
    }

    // Cerrar sesión
   public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // 👈 redirige al formulario de inicio de sesión
}
public function validateAccount($token){

    $user = User::where('remember_token', $token)->first();
    if ($user && $user->remember_token == $token) {
        $user->remember_token = null;
        $user->save();
        return redirect('/login')->with('sucess', 'Account confirmed successfully.');

    }else {
        return redirect('/login')->with('Error',  'ivalid token.');
    }
}


}
