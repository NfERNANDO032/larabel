<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    // 🔍 Mostrar todos los blogs
    public function index()
    {
        return response()->json(Blog::all(), 200);
    }

    // 👁️ Ver un blog específico
    public function show($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json(['error' => 'Blog no encontrado'], 404);
        }
        return response()->json($blog, 200);
    }

    // ➕ Crear un nuevo blog
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'user_id' => 'required|exists:users,id'
    ]);

    $blog = Blog::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => $request->user_id
    ]);

    return response()->json(['message' => 'Blog creado con éxito', 'blog' => $blog], 201);
}


    // ✏️ Actualizar un blog
   public function update(Request $request, $id)
{
    $blog = Blog::find($id);
    if (!$blog) {
        return response()->json(['error' => 'Blog no encontrado'], 404);
    }

    $request->validate([
        'title' => 'sometimes|required|string',
        'content' => 'sometimes|required|string',
    ]);

    if ($request->has('title')) {
        $blog->title = $request->title;
    }
    if ($request->has('content')) {
        $blog->content = $request->content;
    }

    $blog->save();

    return response()->json(['message' => 'Blog actualizado con éxito', 'blog' => $blog], 200);
}


    // 🗑️ Eliminar blog
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json(['error' => 'Blog no encontrado'], 404);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog eliminado con éxito'], 200);
    }

    // 👤 Ver blogs de un usuario
    public function userBlogs($userId)
    {
        $blogs = Blog::where('user_id', $userId)->get();
        return response()->json($blogs, 200);
    }
}
