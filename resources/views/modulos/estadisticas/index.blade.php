@extends('layouts.app')

@section('body')
<!-- Estadísticas Automóvil -->
<div class="px-6 py-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        
       <!-- Lista de Vehículos con enlaces para descargar reporte -->
        <div class="space-y-4">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800">Lista de Reportes</h2>
                <div class="overflow-y-auto max-h-96">  
                    @foreach($costos as $costo)
                        <div class="p-4 mb-2 transition duration-300 rounded-lg shadow-md bg-gray-50 hover:shadow-lg">
                            <a  href="{{ route('estadisticas.descargarReporte', ['id' => $costo->id_automovil]) }}" target="_blank"  class="text-lg font-medium text-blue-600 hover:text-blue-800">
                                Reporte de {{ $costo->marca }} {{ $costo->modelo }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Gráfica de Costos de Mantenimiento por Automóvil -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold text-gray-700 capitalize">Costos de Mantenimiento por Automóvil</h2>
            <canvas id="costosMantenimientoChart" class="w-full h-72"></canvas> 
        </div>

        <!-- Gráfica de Multas por Tipo -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold text-gray-700 capitalize">Número de Multas por Tipo</h2>
            <canvas id="multasPorTipoChart" class="w-full h-72"></canvas>
        </div>

        <!-- Gráfica de Kilometraje Total o Promedio por Vehículo -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold text-gray-700 capitalize">Kilometraje Total por Vehículo</h2>
            <canvas id="kilometrajeChart" class="w-full h-72"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if($costos->isEmpty())
    <div class="py-6 text-center">
        <p class="text-gray-600">No hay costos de mantenimiento disponibles.</p>
    </div>
@else
    <script>
        // Gráfica de Costos de Mantenimiento por Automóvil
        const ctx = document.getElementById('costosMantenimientoChart').getContext('2d');
        const labels = @json($costos->map(fn($item) => $item->marca . ' ' . $item->modelo));
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
                plugins: {
                    legend: { labels: { font: { family: "'Segoe UI', sans-serif" } } },
                    title: { display: true, text: 'Costos de Mantenimiento por Automóvil', font: { family: "'Segoe UI', sans-serif" } }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Gráfica de Multas por Tipo
        const multasPorTipoChart = new Chart(document.getElementById('multasPorTipoChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($multasPorTipo->pluck('tipo_multa')) !!},
                datasets: [{
                    data: {!! json_encode($multasPorTipo->pluck('cantidad')) !!},
                    backgroundColor: [
                        'rgba(83, 109, 254, 0.2)',
                        'rgba(67, 56, 202, 0.7)',
                        'rgba(83, 109, 254, 0.5)',
                        'rgba(67, 56, 202, 0.4)',
                        'rgba(83, 109, 254, 0.8)'
                    ],
                    borderColor: 'rgba(67, 56, 202, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { font: { family: "'Segoe UI', sans-serif" } } },
                    title: { display: true, text: 'Número de Multas por Tipo', font: { family: "'Segoe UI', sans-serif" } }
                }
            }
        });

// Kilometraje Total o Promedio por Vehículo
const kilometrajeCtx = document.getElementById('kilometrajeChart').getContext('2d');
    const labelsKilometraje = @json($kilometrajePorVehiculo->pluck('marca')->map(fn($marca, $index) => $marca . ' ' . $kilometrajePorVehiculo[$index]->modelo));
    const dataKilometraje = @json($kilometrajePorVehiculo->pluck('total_kilometraje'));

    const kilometrajeChart = new Chart(kilometrajeCtx, {
        type: 'bar',
        data: {
            labels: labelsKilometraje,
            datasets: [{
                label: 'Kilometraje Total',
                data: dataKilometraje,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { labels: { font: { family: "'Segoe UI', sans-serif" } } },
                title: { display: true, text: 'Kilometraje Total o Promedio por Vehículo', font: { family: "'Segoe UI', sans-serif" } }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' km';
                        }
                    }
                }
            }
        }
    });

    </script>
@endif

@endsection
