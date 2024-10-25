<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Automóviles - Sistema de Control Vehicular</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <!-- Encabezado -->
    <div id="header">
        <img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="Logo del sistema">
        <div class="infoHeader">
            <h1 class="titulo">Sistema de Control Vehicular</h1>
            <hr>
            <p>Reporte de Automóviles</p>
        </div>
    </div>

    <!-- Contenedor principal -->
    <div class="container" > 
        <h1>Automoviles</h1>
        <!-- Tabla de automóviles -->
        <table class="multas-table">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Submarca</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                    <th>Número de Motor</th>
                    <th>Capacidad Combustible</th>
                    <th>Tipo de Combustible</th>
                    <th>Tipo de Automóvil</th>
                    <th>Kilometraje</th>
                    <th>Placas</th>
                    <th>Número NSI</th>
                    <th>Uso</th>
                    <th>Color</th>
                    <th>Número de Puertas</th>
                    <th>Estatus</th>
                    <th>Fecha de Registro</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Fotografías</th>
                </tr>
            </thead>
            <tbody>
                @foreach($automoviles as $automovil)
                <tr>
                    <td>{{ $automovil->marca }}</td>
                    <td>{{ $automovil->submarca }}</td>
                    <td>{{ $automovil->modelo }}</td>
                    <td>{{ $automovil->num_serie }}</td>
                    <td>{{ $automovil->num_motor }}</td>
                    <td>{{ $automovil->capacidad_combustible }}</td>
                    <td>{{ $automovil->tipo_combustible }}</td>
                    <td>{{ $automovil->tipo_automovil }}</td>
                    <td>{{ $automovil->kilometraje }}</td>
                    <td>{{ $automovil->placas }}</td>
                    <td>{{ $automovil->num_nsi }}</td>
                    <td>{{ $automovil->uso }}</td>
                    <td>{{ $automovil->color }}</td>
                    <td>{{ $automovil->num_puertas }}</td>
                    <td>
                        <span class="estatus {{ strtolower($automovil->estatus) === 'activo' ? 'pagada' : 'pendiente' }}">
                            {{ ucfirst($automovil->estatus) }}
                        </span>
                    </td>
                    <td>{{ $automovil->fecha_registro }}</td>
                    <td>{{ $automovil->responsable }}</td>
                    <td>{{ $automovil->observaciones }}</td>
                    <td>
                        @if($automovil->fotografias)
                            <a href="{{ $automovil->fotografias }}" target="_blank">Ver Fotografías</a>
                        @else
                            No disponible
                        @endif
                    </td>
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
