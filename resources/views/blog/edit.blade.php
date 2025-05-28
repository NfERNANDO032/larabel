{{-- resources/views/blog/edit.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Blog</title>
    <style>
        /* Fondo elegante con gradiente */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #c2e9fb, #a1c4fd);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Contenedor tipo glass */
        .form-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            padding: 40px 30px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #ffffffcc;
            font-weight: 600;
            font-size: 15px;
        }

        input[type="text"],
        textarea {
            width: 95%;
            padding: 14px 16px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            background: #ffffff;
            box-shadow: 0 0 0 2px #a1c4fd;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            width: 100%;
            background: #4caf50;
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #45a049;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 20px;
            background: #6366f1;
            color: #fff;
            padding: 12px 0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
        }
        .btn-back:hover {
            background: #524edc;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Editar Blog</h2>

        {{-- Muestra errores de validación --}}
        @if ($errors->any())
            <div style="margin-bottom: 20px; padding: 12px; background-color: #fde2e2; color: #b91c1c; border-radius: 8px;">
                <ul style="margin:0; padding-left:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Título</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $blog->title) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="content">Contenido</label>
                <textarea
                    id="content"
                    name="content"
                    required
                >{{ old('content', $blog->content) }}</textarea>
            </div>

            <button type="submit">Actualizar</button>
        </form>

        {{-- Botón para volver a la lista de usuarios --}}
        <a href="{{ route('usuarios.index') }}" class="btn-back">
            ← Volver a usuarios
        </a>
    </div>
</body>
</html>
