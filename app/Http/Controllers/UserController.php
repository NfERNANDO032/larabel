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
          $usuarios = User::all();
         return view('usuarios', compact('usuarios'));
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

        return redirect()->back();

    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $usuario = User::find($id);
         return view('editar', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
        $user->name=$request->nombre;
        $user->email=$request->correo;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect('/usuarios');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Buscar al usuario por ID
    $usuario = User::find($id);

    // Verificar si el usuario existe
    if (!$usuario) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    // Eliminar el usuario
    $usuario->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
}


}
