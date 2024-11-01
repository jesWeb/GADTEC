@extends('layouts.app')

@section('body')
<!-- Estadísticas Automóvil -->
<div class="px-4 py-6">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2"> 
        <!-- Gráfica de Costos de Mantenimiento por Automóvil -->
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Costos de Mantenimiento por Automóvil</h2>
            <canvas id="costosMantenimientoChart" class="h-70"></canvas> 
        </div>
        
        <div class="p-6 bg-white rounded-md shadow-md">
            <h1 class="text-lg font-semibold text-gray-700 capitalize">Estadísticas de Multas por Año</h1>

        </div>
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if($costos->isEmpty())
<p>No hay costos de mantenimiento disponibles.</p>
@else
    <script>
        // Gráfica de Costos de Mantenimiento por Automóvil
        const ctx = document.getElementById('costosMantenimientoChart').getContext('2d');

        const labels = @json($costos->map(function($item) {
            return $item->marca . ' ' . $item->modelo;
        }));

        const costosMantenimientoChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, 
                datasets: [{
                    label: 'Costos de Mantenimiento',
                    data: @json($costos->pluck('total_costo')),
                    backgroundColor: 'rgba(83, 109, 254, 0.2)', 
                    borderColor: 'rgba(67, 56, 202, 1)', 
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    </script>
@endif

@endsection