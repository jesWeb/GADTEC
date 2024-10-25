<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Servicios - Sistema de Control Vehicular</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <!-- Encabezado -->
    <div id="header">
        <img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="Logo del sistema">
        <div class="infoHeader">
            <h1 class="titulo">Sistema de Control Vehicular</h1>
            <hr>
            <p>Reporte de Servicios</p>
        </div>
    </div>

    <!-- Contenedor principal -->
    <div class="container">

        <h1>Multas</h1>
        <!-- Tabla de multas -->
        <table class="multas-table">
            <thead>
                <tr>
                    <th>Vehículo</th>
                    <th>Tipo de Servicio</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Estatus</th>
                    <th>Comprobante</th>
                </tr>
            </thead>
            <tbody>
                @foreach($multas as $multa)
                <tr>
                    <td>{{ $multa->automovil->marca }} {{ $multa->automovil->modelo }}</td>
                    <td>{{ $multa->tipo_multa }}</td>
                    <td>{{ $multa->monto }}</td>
                    <td>{{ $multa->fecha_multa }}</td>
                    <td>{{ $multa->lugar }}</td>
                    <td>
                        <span class="estatus {{ strtolower($multa->estatus) === 'pagada' ? 'pagada' : 'pendiente' }}">
                            {{ ucfirst($multa->estatus) }}
                        </span>


                    </td>
                    <td>
                        @if($multa->comprobante)
                            <a href="{{ $multa->comprobante }}" target="_blank">Ver Comprobante</a>
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
