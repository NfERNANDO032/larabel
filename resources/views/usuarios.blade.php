<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
</head>

<body>
    <h1>Listado de Usuarios</h1>

    @if(session('success'))
    <div>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>

                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>


                <td>
                    <!-- Enlace para ver el usuario (por ejemplo) -->
                    <a href="{{ route('usuarios.show', $usuario->id) }}">Ver</a>
                  <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form> 

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

   <a href="/usuarios/create/us">Agregar Nuevo Usuario</a>

</body>

</html>