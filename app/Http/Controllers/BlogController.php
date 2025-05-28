<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BlogController extends Controller
{
    // Mostrar el formulario
    public function create()
    {
        return view('blog.create');

    }

    // Procesar el formulario
    public function store(Request $request)
    {
        $remember_token = bin2hex(random_bytes(10));
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;

        $blog->user_id = Auth::user()->id;


        $blog->save();


        return redirect()->back()->with('success', '¡Registro exitoso!');

        dd($request->all());
        // Aquí iría el modelo, por ejemplo:
        // Post::create($validated);

        //return redirect()->route('c')->with('success', '¡Publicación creada exitosamente!');
    }

    public function index()
    {
        return view(''); // Asegúrate de tener la vista correspondiente
    }

    public function userPosts($id)
    {
        $user = User::findOrFail($id);
        $blogs = $user->blogs;   // <-- cambio de $posts a $blogs

        return view('blog.user-posts', compact('user', 'blogs'));
    }
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.show', compact('blog'));
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        // Sólo el autor puede editar
        if ($blog->user_id !== Auth::id()) {
            abort(403);
        }

        return view('blog.edit', compact('blog'));
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== Auth::id()) {
            abort(403);
        }

        // Valida antes de guardar
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update($data);

        return redirect()
            ->route('posts.show', $blog->id)
            ->with('success', 'Blog actualizado correctamente.');
    }
    public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    if ($blog->user_id !== Auth::id()) {
        abort(403);
    }

    $blog->delete();

    return redirect()
        ->route('user.posts', $blog->user_id)
        ->with('success', 'Blog eliminado correctamente.');
}



}

