<?php

namespace App\Http\Controllers;

use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return response()->json(User::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome'); // ✅ Esto carga tu formulario de registro personalizado
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $remember_token =bin2hex(random_bytes(10));
        $user= new User();
        $user->name=$request->nombre;
        $user->email=$request->correo;
        $user->password=bcrypt($request->password);
        $user->remember_token= $remember_token;
        $user->save();
        $user ->notify(new UserNotification());

        return redirect()->json([
            'mensaje' => 'Usuario creado correctamente'
        ], 201);

    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
         $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $request->validate([
        'name' => 'sometimes|required|string',
        'email' => 'sometimes|required|string|email|unique:users,email,' . $id,
        'password' => 'sometimes|required|string|min:6',
    ]);

    if ($request->has('name')) {
        $user->name = $request->name;
    }

    if ($request->has('email')) {
        $user->email = $request->email;
    }

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return response()->json(['message' => 'Usuario actualizado con éxito', 'user' => $user], 200);
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
    }
public function showPosts($id)
{
    $usuario = User::findOrFail($id);
    $posts = $usuario->posts; // Asumiendo que tienes la relación definida
    
    return view('user.posts', compact('usuario', 'posts'));
}


}
