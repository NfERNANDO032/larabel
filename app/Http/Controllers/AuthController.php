<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // 🔐 Registrar usuario
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Opcional: loguear automáticamente al registrarse
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user,
        ], 201);
    }

    // 🔓 Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    // 👤 Perfil del usuario autenticado
    public function profile()
    {
        return response()->json(auth()->user());
    }

    // 🚪 Cerrar sesión
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Sesión cerrada con éxito']);
    }
}
