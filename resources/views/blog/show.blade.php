{{-- resources/views/blog/show.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $blog->title }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 2rem;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 1.5rem;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    h1 {
      margin-top: 0;
      font-size: 2rem;
    }
    .meta {
      color: #666;
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
    }
    .content {
      line-height: 1.6;
      margin-bottom: 2rem;
    }
    .btn {
      display: inline-block;
      margin-right: 0.5rem;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
      color: #fff;
      transition: background 0.2s;
    }
    .btn-back { background: #888; }
    .btn-edit { background: #4caf50; }
    .btn-delete { background: #e53e3e; border: none; cursor: pointer; }
    .btn-back:hover { background: #666; }
    .btn-edit:hover { background: #45a049; }
    .btn-delete:hover { background: #c53030; }
    form { display: inline; }
  </style>
</head>
<body>
  <div class="container">
    <h1>{{ $blog->title }}</h1>
    <p class="meta">
      Por {{ $blog->user->name }} — {{ $blog->created_at->format('d/m/Y') }}
    </p>
    <div class="content">
      {{ $blog->content }}
    </div>

    {{-- Siempre volver a lista de usuarios --}}
    <a href="{{ route('usuarios.index') }}" class="btn btn-back">
      ← Volver a usuarios
    </a>

    {{-- Editar y Eliminar sólo si eres el autor --}}
    @auth
      @if(auth()->id() === $blog->user_id)
        <a href="{{ route('posts.edit', $blog->id) }}" class="btn btn-edit">
          ✏️ Editar
        </a>

        <form action="{{ route('posts.destroy', $blog->id) }}" method="POST"
              onsubmit="return confirm('¿Eliminar este blog?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-delete">
            🗑 Eliminar esto
          </button>
        </form>
      @endif
    @endauth
  </div>
</body>
</html>
