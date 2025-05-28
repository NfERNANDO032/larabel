<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear Blog</title>
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
            background: #4facfe;
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
            background: #00f2fe;
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
        <form action="{{ route('posts.store') }}" method="POST">



            <h2>Crear Nuevo Blog</h2>
            @csrf
            @if (session('success'))
                <div
                    style="margin-bottom: 20px; padding: 12px; background-color: #d4edda; color: #155724; border-radius: 8px; font-weight: bold;">
                    {{ session('success') }}
                </div>
            @endif


            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" placeholder="Escribe el título del blog" required>
            </div>

            <div class="form-group">
                <label for="content">Contenido</label>
                <textarea id="content" name="content" placeholder="Escribe el contenido aquí..." required></textarea>
            </div>

            <button type="submit">Publicar</button>

        </form>
        {{-- Botón para volver a la lista de usuarios --}}
        <a href="{{ route('usuarios.index') }}" style="display:block;
              margin-top:20px;
              text-align:center;
              padding:10px 0;
              background:#6366f1;
              color:#fff;
              border-radius:8px;
              text-decoration:none;
              font-weight:500;">
            ← Volver a usuarios
        </a>

    </div>
</body>

</html>