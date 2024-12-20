<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Multas - Sistema de Control Vehicular</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <!-- Encabezado -->
    <div id="header">
        <img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="Logo del sistema">
        <div class="infoHeader">
            <h1 class="titulo">Sistema de Control Vehicular</h1>
            <hr>
            <p>Reporte de Multas</p>
        </div>
    </div>

    <!-- Contenedor principal -->
    <div class="container">

        <h1>Servicios</h1>
        <!-- Tabla de multas -->
        <table class="multas-table">
            <thead>
                <tr>
                    <th>Vehículo</th>
                    <th>Tipo de Servicio</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Proximo Servicio</th>
                    <th>Costo</th>
                    <th>Lugar de Servicio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->automovil->marca }} {{ $servicio->automovil->submarca }} {{ $servicio->automovil->modelo }} </td>
                    <td>{{ $servicio ->tipo_servicio }}</td>
                    <td>{{ $servicio-> descripcion }}</td>
                    <td>
                        @if($servicio->fecha_servicio == '')
                            <!-- Muestra un guión o un texto vacío si el servicio no es programado -->
                            -
                        @else
                            {{ $servicio->fecha_servicio }}
                        @endif
                    </td>
                    <td>
                        @if($servicio->prox_servicio == '')
                            <!-- Muestra un guión o un texto vacío si el servicio no es programado -->
                            No aplica
                        @else
                            {{ $servicio->prox_servicio }}
                        @endif
                    </td>
                    <td>{{ $servicio ->costo}}</td>
                    <td>{{ $servicio -> lugar_servicio}}</td>
                    
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
