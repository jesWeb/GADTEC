@extends('layouts.app')

@section('body')
    <div class="px-6 py-4">
        <div class="mt-8">
            <div class="p-6 bg-white shadow-xl rounded-xl">
                <h2 class="text-2xl font-bold text-gray-800">Solicitud de Vehículo</h2>

                <form id="solicitudForm" action="{{ route('solicitudes.store') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-lg font-semibold text-gray-700">Vehículo</label>
                            <select name="id_automovil" id="vehiculo"
                                class="w-full px-4 py-3 mt-2 text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                required>
                                <option value="" disabled selected>Selecciona un vehículo...</option>
                                @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_automovil }}">{{ $vehiculo->modelo }} -
                                        {{ $vehiculo->marca }} {{ $vehiculo->submarca }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-lg font-semibold text-gray-700">Motivo</label>
                            <input type="text" name="motivo" id="motivo"
                                class="w-full px-4 py-3 mt-2 text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                placeholder="Ejemplo: Reunión de trabajo" required>
                        </div>

                        <div>
                            <label class="block text-lg font-semibold text-gray-700">Lugar</label>
                            <input type="text" name="lugar" id="lugar"
                                class="w-full px-4 py-3 mt-2 text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                placeholder="Ejemplo: Oficinas centrales" required>
                        </div>

                        <!-- Requiere Chofer -->
                        <div class="mb-4">
                            <label for="requierechofer" class="block text-lg font-semibold text-gray-800">¿Requiere
                                Conductor?</label>

                            <div class="flex items-center gap-2 mt-2">
                                <input type="checkbox" id="requierechofer" name="requierechofer" value="1"
                                    class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                    onclick="toggleChoferInput()" {{ old('requierechofer') ? 'checked' : '' }}
                                    title="¿Requieres chofer?">
                                <label for="requierechofer" class="text-base font-medium text-gray-700">Sí</label>
                            </div>
                        </div>

                        <!-- Nombre del Conductor -->
                        <div id="choferInput" class="hidden mt-4">
                            <label for="nombre_chofer" class="block text-lg font-semibold text-gray-800">
                                Nombre del Conductor
                            </label>
                            <input type="text" id="nombre_chofer" name="nombre_chofer" value="{{ old('nombre_chofer') }}"
                            class="w-full px-4 py-3 mt-2 text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                            placeholder="Ingresa el nombre del conductor" title="Ingresa el nombre del chofer" />
                        </div>

                    </div>

                    <!-- Calendario -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800">Disponibilidad del Vehículo</h3>
                        <div id="calendar" class="p-3 mt-3 rounded-md shadow-xs"></div> 

                    </div>

                     <input type="hidden" name="fecha_salida" id="fecha_salida">
                            <input type="hidden" name="hora_salida" id="hora_salida">

                            <div class="flex justify-end mt-8 space-x-4">
                                <a href="#"
                                    class="px-5 py-3 text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                                <button type="submit"
                                    class="px-5 py-3 text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
                            </div> 
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts de FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        #calendar {
            font-family: 'Inter', sans-serif;
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para la cabecera */
        .fc-toolbar-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            color: #18177a;
        }

        .fc-toolbar-title {
            text-transform: capitalize !important;
        }

        .fc-col-header-cell-cushion {
            text-transform: capitalize !important;
        }


        /* Botones modernos */
        .fc-button {
            background-color: #4f46e5 !important;
            border: none !important;
            color: white !important;
            border-radius: 6px !important;
            padding: 6px 12px !important;
            font-size: 14px;
            margin: 5px !important;

        }

        .fc-button:hover {
            background-color: #6d28d9 !important;
        }


        /* Estilos mejorados para eventos */
        .event-blue {
            background-color: rgba(93, 115, 241, 0.63) !important;
            color: #3f1cdb !important;
            border-radius: 6px !important;
            padding: 6px !important;
            font-size: 12px;
        }

        .event-red {
            background-color: rgba(238, 22, 22, 0.5) !important;
            color: #ec1313 !important;
            border: none !important;
            /* Asegura que no haya bordes */
            border-radius: 6px !important;
            padding: 6px !important;
            font-size: 11px;
        }

        .event-red {
            border-top: none !important;
        }

        /* Estilización de la cuadrícula */
        .fc-timegrid-slot {
            height: 50px !important;
            background-color: #ffff !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        /* Fondo gris para los días con eventos */
        .fc-daygrid-day.fc-day-today {
            background-color: #ecf0f8 !important;
            /* Gris claro */
        }

        /* Asegurar que el texto siga siendo legible */
        .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
            color: #111827 !important;
            /* Gris oscuro para contraste */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let vehiculoSelect = document.getElementById('vehiculo');
            let fechaSalida = document.getElementById('fecha_salida');
            let horaSalida = document.getElementById('hora_salida');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'es',
                slotMinTime: "06:00:00",
                slotMaxTime: "22:00:00",
                // slotDuration: "00:10:00",
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short' // AM/PM en las franjas horarias
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short' // AM/PM en los eventos
                },
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                columnHeaderFormat: {
                    weekday: 'long' // Se mantendrá en minúsculas por defecto
                },
                titleFormat: {
                    year: 'numeric',
                    month: 'long' // Cambia el formato para que los meses comiencen con mayúscula
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                select: function(info) {
                    fechaSalida.value = info.startStr.split("T")[0];
                    horaSalida.value = info.startStr.split("T")[1].substring(0, 5);
                    alert(`Seleccionaste: ${info.startStr}`);
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    let id_automovil = vehiculoSelect.value;

                    if (!id_automovil || id_automovil === "") {
                        console.warn("No se ha seleccionado un vehículo.");
                        return;
                    }

                    fetch(`/api/reservaciones?id_automovil=${id_automovil}`)
                        .then(response => response.json())
                        .then(reservaciones => {
                            let eventos = reservaciones.map(reservacion => ({
                                title: `${reservacion.estatus.toUpperCase()} - ${reservacion.hora_salida}`,
                                start: `${reservacion.fecha_salida}T${reservacion.hora_salida}`,
                                end: `${reservacion.fecha_salida}T${reservacion.hora_salida}`,
                                className: reservacion.estatus === "Autorizado" ?
                                    "event-blue" : "event-red"
                            }));
                            successCallback(eventos);
                        })
                        .catch(error => {
                            console.error("Error al cargar reservaciones:", error);
                            failureCallback(error);
                        });
                }
            });

            calendar.render();

            vehiculoSelect.addEventListener('change', function() {
                if (vehiculoSelect.value) {
                    calendar.refetchEvents();
                }
            });
        });
    </script>
    <script>
        function toggleChoferInput() {
            const choferInput = document.getElementById('choferInput');
            const requiereChofer = document.getElementById('requierechofer');

            if (requiereChofer.checked) {
                choferInput.classList.remove('hidden');
            } else {
                choferInput.classList.add('hidden');
            }
        }
    </script>
@endsection
