<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario Espacial Para que Confirma</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            overflow: hidden;
            background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
            color: #fff;
        }

        /* Fondo animado de estrellas */
        .stars {
            width: 100%;
            height: 100%;
            background: transparent url('https://raw.githubusercontent.com/VincentGarreau/particles.js/master/demo/media/star-bg.jpg') repeat;
            animation: moveStars 100s linear infinite;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            opacity: 0.3;
        }

        @keyframes moveStars {
            from {
                background-position: 0 0;
            }

            to {
                background-position: -10000px 5000px;
            }
        }

        .form-container {
            position: relative;
            z-index: 1;
            width: 400px;
            max-width: 90%;
            margin: 80px auto;
            background-color: rgba(0, 0, 0, 0.75);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #00d2ff;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background: #1e2a38;
            color: #fff;
        }

        input::placeholder {
            color: #bbb;
        }

        select {
            color: #fff;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #00d2ff, #3a7bd5);
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(to right, #3a7bd5, #00d2ff);
        }

        .btn-login {
            margin-top: 15px;
            background: linear-gradient(to right, #667eea, #764ba2) !important;
        }

        .btn-login:hover {
            background: linear-gradient(to right, #764ba2, #667eea) !important;
        }

        @media (max-width: 500px) {
            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="stars"></div>
    <div class="form-container">
        <h2>🌌 Registro Galáctico Xd</h2>

        {{-- Mostrar mensaje de éxito si existe --}}
        @if(session('success'))
            <div style="background: #28a745; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mostrar errores si existen --}}
        @if ($errors->any())
            <div style="background: #dc3545; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registro.store') }}" method="POST">
            @csrf

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>

            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="000-000-0000">

            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username" placeholder="usuario123" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>

            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="">-- Selecciona un roles --</option>
                <option value="admin">Administrador</option>
                <option value="user">Usuario</option>
            </select>

            <button type="submit">🚀 Registrar</button>
            <div>
                <a href="/login" class="btn-add">iniciar sesión
                    <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4h7a4 4 0 0 1 4 4v2"></path>
                        <polyline points="17 21 21 17 17 13"></polyline>
                        <line x1="21" y1="17" x2="9" y2="17"></line>
                    </svg>
                </a>
            </div>
        </form>



    </div>


</body>

</html>