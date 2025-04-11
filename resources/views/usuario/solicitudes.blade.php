@extends('layouts.app')

@section('body')
    <div class="px-6 py-4">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-6">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('user.dashboard') }}" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="iconCarrier">
                                    <!-- Documento -->
                                    <rect x="6" y="3" width="12" height="18" rx="2" stroke="currentColor">
                                    </rect>
                                    <path d="M9 7H15" stroke="currentColor"></path>
                                    <path d="M9 11H15" stroke="currentColor"></path>
                                    <path d="M9 15H13" stroke="currentColor"></path>
                                    <!-- Usuario -->
                                    <circle cx="17" cy="17" r="3" stroke="currentColor"></circle>
                                    <path d="M17 20V21" stroke="currentColor"></path>
                                    <path d="M17 14V15" stroke="currentColor"></path>
                                </g>
                            </svg>
                            Mis solicitudes
                        </a>
                    </li>
                    <p class="text-gray-500">/</p>
                    <li>
                        <span class="text-gray-800 font-semibold">Solicitar Prestamo</span>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="mt-8">
            <div class="p-6 bg-white rounded-xl shadow-xl">
                <h2 class="text-2xl font-bold text-gray-800">Solicitud de Vehículo</h2>
                <div id="cancelAlert" class="hidden p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                    Solicitud cancelada. No se ha registrado ningún cambio.
                </div>

                @if (session('error'))
                    <div id="errorModal"
                        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-2xl font-bold text-red-600">¡Error!</h2>
                            <p class="mt-2 text-gray-800">{!! nl2br(e(session('error'))) !!}</p>
                            <div class="flex justify-center pt-2">
                                <button onclick="cerrarModal()"
                                    class="w-full py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <script>
                    function cerrarModal() {
                        document.getElementById('errorModal').classList.add('hidden');
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        let modal = document.getElementById('errorModal');
                        if (modal.querySelector('p').innerText.trim() !== '') {
                            modal.classList.remove('hidden');
                        }
                    });
                </script>

                <!-- Formulario -->
                <form id="solicitudForm" action="{{ route('solicitudes.store') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-lg font-semibold text-gray-700">Vehículo</label>
                            <select name="id_automovil" id="vehiculo"
                                class="w-full mt-2 rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
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
                                class="w-full mt-2 rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                placeholder="Ejemplo: Reunión de trabajo" required>
                        </div>

                        <div>
                            <label class="block text-lg font-semibold text-gray-700">Lugar</label>
                            <input type="text" name="lugar" id="lugar"
                                class="w-full mt-2 rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                placeholder="Ejemplo: Oficinas centrales" required>
                        </div>

                        <!-- Requiere Chofer -->
                        <div class="mb-4">
                            <label for="requierechofer" class="block text-lg font-semibold text-gray-800">¿Requiere
                                Conductor?</label>

                            <div class="flex items-center gap-2 mt-2">
                                <input type="checkbox" id="requierechofer" name="requierechofer" value="1"
                                    class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
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
                                class="w-full mt-2 rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                placeholder="Ingresa el nombre del conductor" title="Ingresa el nombre del chofer" />
                        </div>
                    </div>

                    <!-- Calendario -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800">Disponibilidad del Vehículo</h3>
                        <div id="calendar" class="mt-3 rounded-md shadow-sm p-3"></div>
                    </div>

                    <input type="hidden" name="fecha_salida" id="fecha_salida">
                    <input type="hidden" name="hora_salida" id="hora_salida">

                    <div class="flex justify-end mt-8 space-x-4">
                        <a href="#"
                            class="px-5 py-3 text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                        <button type="button" id="submitBtn"
                            class="px-5 py-3 text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-96">
            <h2 class="text-2xl font-bold text-gray-800">Confirmación de Solicitud</h2>
            <p class="mt-2 text-gray-600">¿Estás seguro de que los datos ingresados son correctos?</p>
            <p id="confirmSummary" class="mt-4 text-gray-700"></p>
            <div class="flex justify-end space-x-4 mt-4">
                <a href="javascript:void(0);" onclick="cancelarSolicitud()"
                    class="px-5 py-3 text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </a>
                <button id="confirmButton" onclick="confirmAndSubmit()"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Confirmar</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("solicitudForm");
            const submitButton = document.getElementById("submitBtn");
            const confirmModal = document.getElementById("confirmModal");
            const confirmButtonModal = document.getElementById("confirmButton");
            const confirmSummary = document.getElementById("confirmSummary");

            // Utilizar el calendario en formato de día, mes y año (DD/MM/YYYY)
            const dateInput = document.getElementById("fecha_salida");
            const timeInput = document.getElementById("hora_salida");

            // Formatear la fecha en formato DD/MM/YYYY
            function formatDate(date) {
                let d = new Date(date);
                let day = ("0" + d.getDate()).slice(-2); // Día con dos dígitos
                let month = ("0" + (d.getMonth() + 1)).slice(-2); // Mes con dos dígitos
                let year = d.getFullYear(); // Año
                return `${day}/${month}/${year}`;
            }

            // Formatear la hora en formato de 12 horas (hh:mm AM/PM)
            function formatTime(date) {
                let hours = date.getHours();
                let minutes = ("0" + date.getMinutes()).slice(-2);
                let ampm = hours >= 12 ? "PM" : "AM";
                hours = hours % 12;
                hours = hours ? hours : 12; // La hora 0 es 12 AM
                return `${hours}:${minutes} ${ampm}`;
            }

            // Evento para capturar la fecha y hora seleccionadas
            submitButton.addEventListener("click", function() {
                // Obtener los datos del formulario
                const vehiculo = document.getElementById("vehiculo").options[document.getElementById(
                    "vehiculo").selectedIndex].text;
                const motivo = document.getElementById("motivo").value;
                const lugar = document.getElementById("lugar").value;
                const fechaSalida = document.getElementById("fecha_salida").value;
                const horaSalida = document.getElementById("hora_salida").value;

                // Convertir la fecha seleccionada a un formato adecuado
                let formattedDate = formatDate(fechaSalida);
                let formattedTime = formatTime(new Date(`1970-01-01T${horaSalida}:00`));

                // Actualizar el contenido del modal con toda la información formateada
                confirmSummary.innerHTML = `
                    <strong>Vehículo:</strong> ${vehiculo} <br>
                    <strong>Motivo:</strong> ${motivo} <br>
                    <strong>Lugar:</strong> ${lugar} <br>
                    <strong>Fecha y Hora de Salida:</strong> ${formattedDate} ${formattedTime} <br>
                `;
                confirmModal.classList.remove('hidden');
            });

            // Confirmar y enviar el formulario
            window.confirmAndSubmit = function() {
                form.submit();
            };

            // Fuera del DOMContentLoaded
            window.closeConfirmModal = function() {
                document.getElementById('confirmModal').classList.add('hidden');
            };

            window.cancelarSolicitud = function() {
                document.getElementById("solicitudForm").reset();

                // Ocultar el input del chofer si estaba visible
                document.getElementById("choferInput").classList.add("hidden");

                // También puedes limpiar los campos ocultos si es necesario
                document.getElementById("fecha_salida").value = "";
                document.getElementById("hora_salida").value = "";

                const alertBox = document.getElementById('cancelAlert');
                alertBox.classList.remove('hidden');

                closeConfirmModal();

                setTimeout(() => {
                    alertBox.classList.add('hidden');
                }, 3000);
            };

        });
    </script>


    <!-- Scripts de FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        #calendar {
            font-family: 'Inter', sans-serif;
            background: white;
            border-radius: 10px;
            padding: 15px;
            max-width: 100%;
            height: 400px;
            font-size: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .fc-toolbar-title {
            font-weight: bold;
            text-align: center;
            color: #18177a;
            font-size: 1.2rem !important;

        }

        .fc-toolbar-title {
            text-transform: capitalize !important;
        }

        .fc-col-header-cell-cushion {
            text-transform: capitalize !important;
        }

        .fc-daygrid-day-number {
            font-size: 10px !important;
        }


        .fc-button {
            background-color: #4f46e5 !important;
            border: none !important;
            color: white !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            font-size: 12px;
            margin: 5px !important;

        }

        #confirmModal {
            z-index: 1050 !important;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
        }

        .fc-button:hover {
            background-color: #6d28d9 !important;
        }


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
            border-radius: 6px !important;
            padding: 6px !important;
            font-size: 11px;
        }

        .event-red {
            border-top: none !important;
        }

        .fc-timegrid-slot {
            height: 50px !important;
            background-color: #ffff !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        .fc-event {
            font-size: 10px !important;
            padding: 3px !important;
        }

        .fc-daygrid-day {
            min-height: 50px !important;
        }

        .fc-daygrid-day.fc-day-today {
            background-color: #ecf0f8 !important;
        }

        .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
            color: #111827 !important;
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
                slotMaxTime: "23:00:00",
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                columnHeaderFormat: {
                    weekday: 'long'
                },
                titleFormat: {
                    year: 'numeric',
                    month: 'long'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                select: function(info) {
                    // Obtener fecha y hora seleccionadas
                    const selectedDate = info.startStr.split("T")[0]; // Fecha
                    const selectedTime = info.startStr.split("T")[1].substring(0, 5); // Hora (HH:mm)

                    // Asignar los valores a los campos ocultos
                    fechaSalida.value = selectedDate;
                    horaSalida.value = selectedTime;

                    // Mostrar el valor en el modal (puedes ponerlo en el alert si es para depuración)
                    alert(`Fecha: ${selectedDate}, Hora: ${selectedTime}`);
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
