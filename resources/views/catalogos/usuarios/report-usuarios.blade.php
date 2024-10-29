<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios - Sistema de Control Vehicular</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <!-- Encabezado -->
    <div id="header">
        <img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="Logo del sistema">
        <div class="infoHeader">
            <h1 class="titulo">Sistema de Control Vehicular</h1>
            <hr>
            <p>Reporte de Usuarios</p>
        </div>
    </div>

    <!-- Contenedor principal -->
    <div class="container">

        <h1>Usuarios</h1>
        <!-- Tabla de multas -->
        <table class="multas-table">
            <thead>
                <tr>
                    <th>Num Empleado</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Rol</th>
                    <th>Usuario</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario ->num_empleado }}</td>
                    <td>{{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }}</td>
                    <td>{{ $usuario ->empresa }}</td>
                    <td>{{ $usuario ->rol }}</td>
                    <td>{{ $usuario ->usuario }}</td>
                   
                 
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pie de página -->
    <div id="footer">
        <p class="textFooter">Sistema de Control Vehicular</p>
    </div>
</body>
</html>
