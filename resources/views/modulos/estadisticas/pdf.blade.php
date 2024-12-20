
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reporte de Vehículo - Sistema de Control Vehicular</title>
	<link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
	<!-- Encabezado -->
	<div id="header">
    	<img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="Logo del sistema">
    	<div class="infoHeader">
        	<h1>Sistema de Control Vehicular</h1>
        	<hr>
        	<p>Reporte de Vehículo</p>
    	</div>
	</div>

	<!-- Contenido principal -->
	<div class="container">
    	<div class="title">Información del Vehículo</div>
    	<div class="section">
        	<h2>Datos del Vehículo</h2>
        	<p>Marca: {{ $vehiculo->marca }}</p>
        	<p>Modelo: {{ $vehiculo->modelo }}</p>
    	</div>

    	<!-- Sección de Multas -->
    	<div class="section">
        	<h2>Multas</h2>
        	@if($vehiculo->multas->isEmpty())
            	<p>No existen multas registradas para este vehículo.</p>
        	@else
            	<table>
                	<thead>
                    	<tr>
                        	<th>Tipo de Multa</th>
                        	<th>Monto</th>
                        	<th>Fecha</th>
                        	<th>Lugar</th>
                        	<th>Estatus</th>
                        	<th>Comprobante</th>
                    	</tr>
                	</thead>
                	<tbody>
                    	@foreach($vehiculo->multas as $multa)
                    	<tr>
                        	<td>{{ $multa->tipo_multa }}</td>
                        	<td>${{ number_format($multa->monto, 2) }}</td>
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
            	<p class="total">Total de Multas: ${{ number_format($totalMultas, 2) }}</p>
        	@endif
    	</div>

    	<!-- Sección de Servicios -->
    	<div class="section">
        	<h2>Servicios</h2>
        	@if($vehiculo->servicios->isEmpty())
            	<p>No existen servicios registrados para este vehículo.</p>
        	@else
            	<table>
                	<thead>
                    	<tr>
                        	<th>Tipo de Servicio</th>
                        	<th>Costo</th>
                    	</tr>
                	</thead>
                	<tbody>
                    	@foreach($vehiculo->servicios as $servicio)
                    	<tr>
                        	<td>{{ $servicio->tipo_servicio }}</td>
                        	<td>${{ number_format($servicio->costo, 2) }}</td>
                    	</tr>
                    	@endforeach
                	</tbody>
            	</table>
            	<p class="total">Total de Servicios: ${{ number_format($totalServicios, 2) }}</p>
        	@endif
    	</div>

    	<!-- Verificaciones -->
        <div class="section">
            <h2>Verificaciones</h2>
            <table>
                <thead>
                    <tr>
                        <th>Holograma</th>
                        <th>Próxima Verificación</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiculo->verificacion as $verificacion)
                    <tr>
                        <td>{{ $verificacion->engomado }}</td>
                        <td>{{ date('d/m/Y', strtotime($verificacion->proxima_verificacion)) }}</td>
                        <td>${{ number_format($verificacion->monto ?? 0, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="total">Total de Verificaciones: ${{ number_format($totalVerificaciones, 2) }}</p>
        </div>

       
        <div class="section">
            <h2>Costo Total</h2>
            <p class="total">Costo Total de Multas, Servicios y Verificaciones: ${{ number_format($costoTotal, 2) }}</p>
        </div>
	</div>

	<!-- Pie de página -->
	<div id="footer">
    	<p class="textFooter"> Sistema de Control Vehicular</p>
	</div>
</body>
</html>
