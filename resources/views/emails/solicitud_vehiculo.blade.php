<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud de Vehículo</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #5e72e4;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .highlight {
            font-weight: bold;
            color: #333;
        }
        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5e72e4;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 20px;
        }
        .cta-button:hover {
            background-color: #4a60d7;
        }
        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>¡Nueva Solicitud de Vehículo!</h1>
        <p>Se ha registrado una nueva solicitud de préstamo de vehículo realizada por <span class="highlight">{{ $usuario }} {{ $apm }} {{ $app }}</span>.</p>
        
        <p><span class="highlight">Vehículo:</span> {{ $vehiculo }} - {{ $marca }}</p>
        <p><span class="highlight">Motivo:</span> {{ $motivo }}</p>
        <p><span class="highlight">Fecha de salida:</span> {{ $fecha_salida }} a las {{ $hora_salida }}</p>

        <a href="{{ route('admin.dashboard') }}" class="cta-button">Ver Solicitud</a>

        <div class="footer">
            <p>Este correo ha sido enviado automáticamente por el Sistema de Control Vehicular.</p>
        </div>
    </div>
</body>
</html>
