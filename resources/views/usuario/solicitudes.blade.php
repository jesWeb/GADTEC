@extends('layouts.app')

@section('body')
    <!-- CSS de Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

                <!-- Alerta de cancelación -->
                <div id="alertaCancelacion"
                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
                    <div class="bg-white px-6 py-4 rounded-lg shadow-xl max-w-md text-center">
                        <h2 class="text-xl font-bold text-red-600 mb-2">¡Solicitud cancelada!</h2>
                        <p class="text-gray-800">Tu solicitud ha sido cancelada y no se registró en el sistema.</p>
                    </div>
                </div>


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

                        <!-- Fecha y Hora -->
                        <div>
                            <label class="block text-lg font-semibold text-gray-700">Selecciona fecha y hora del
                                préstamo</label>

                            <input type="text" name="fecha_hora" id="fecha_hora"
                                class="flatpickr w-full mt-2 rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                placeholder="Selecciona fecha y hora" required>

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


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
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
                                <input type="text" id="nombre_chofer" name="nombre_chofer"
                                    value="{{ old('nombre_chofer') }}"
                                    class="w-full mt-2 rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                    placeholder="Ingresa el nombre del conductor" title="Ingresa el nombre del chofer" />
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-end mt-8 space-x-4">
                        <a href="{{ route('user.dashboard') }}"
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
                <a href="#" onclick="cancelarSolicitud()"
                    class="px-5 py-3 text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </a>
                <button id="confirmButton" onclick="confirmAndSubmit()"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- JS de Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("solicitudForm");
            const submitButton = document.getElementById("submitBtn");
            const confirmModal = document.getElementById("confirmModal");
            const confirmSummary = document.getElementById("confirmSummary");

            function formatFechaHora(fechaHoraStr) {
                const date = new Date(fechaHoraStr);
                if (isNaN(date)) return fechaHoraStr; // por si algo sale mal
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                return date.toLocaleString('es-MX', options);
            }

            submitButton.addEventListener("click", function() {
                const vehiculoSelect = document.getElementById("vehiculo");
                const vehiculo = vehiculoSelect.options[vehiculoSelect.selectedIndex]?.text || '';
                const motivo = document.getElementById("motivo").value;
                const lugar = document.getElementById("lugar").value;
                const fechaHora = document.getElementById("fecha_hora").value;

                if (!vehiculo || !motivo || !lugar || !fechaHora) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos incompletos',
                        text: 'Por favor, completa todos los campos antes de continuar.',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#FF5733', 
                        background: '#FFFF', 
                        iconColor: '#FF5733', 
                        showCloseButton: true, 
                        allowOutsideClick: false 
                    });
                    return;
                }

                confirmSummary.innerHTML = `
                <strong>Vehículo:</strong> ${vehiculo}<br>
                <strong>Motivo:</strong> ${motivo}<br>
                <strong>Lugar:</strong> ${lugar}<br>
                <strong>Fecha y Hora:</strong> ${formatFechaHora(fechaHora)}<br>
            `;
                confirmModal.classList.remove('hidden');
            });

            window.confirmAndSubmit = function() {
                form.submit();
            };

            window.closeConfirmModal = function() {
                document.getElementById('confirmModal').classList.add('hidden');
            };

            window.cancelarSolicitud = function() {
                document.getElementById('confirmModal').classList.add('hidden');

                const alerta = document.getElementById('alertaCancelacion');
                alerta.classList.remove('hidden');

                setTimeout(() => {
                    window.location.href = "{{ route('user.dashboard') }}";
                }, 2500);
            };

        });
    </script>


    <script>
        let flatpickrInstance = null;

        function initFlatpickr(disabledRanges = []) {
            if (flatpickrInstance) flatpickrInstance.destroy();

            flatpickrInstance = flatpickr("#fecha_hora", {
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
                            'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                dateFormat: "Y-m-d H:i",
                enableTime: true,
                time_24hr: true,
                minuteIncrement: 30,
                minDate: new Date(),
                disable: disabledRanges, // Deshabilitar fechas ocupadas
                onChange: function(selectedDates, dateStr, instance) {
                    const selectedDate = selectedDates[0];

                    const isOccupied = disabledRanges.some(range => {
                        const start = range.from.getTime();
                        const end = range.to.getTime();

                        return selectedDate.getTime() >= start && selectedDate.getTime() < end;
                    });

                    if (isOccupied) {
                        instance.close();

                        Swal.fire({
                            icon: 'error',
                            title: '¡Fecha y hora ocupadas!',
                            text: 'La fecha y hora seleccionadas ya están ocupadas. Por favor, elige otra.',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                            background: '#FFFF',
                            showCloseButton: true,
                            position: 'center',
                            customClass: {
                                popup: 'swal-wide',
                            }
                        }).then(() => {
                            instance.clear();
                        });
                    }
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            initFlatpickr(); // Inicializamos el calendaro

            document.getElementById('vehiculo').addEventListener('change', function() {
                const vehiculoId = this.value;

                if (!vehiculoId) return;

                fetch(`/api/vehiculos/${vehiculoId}/horarios`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la respuesta del servidor.");
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        console.log("Horarios ocupados:", data);

                        const disabledRanges = data.map(h => ({
                            from: new Date(Date.parse(h.from)),
                            to: new Date(Date.parse(h.to))
                        }));

                        console.log("Horarios ocupados convertidos:", disabledRanges);

                        // Re-inicializamos el calendario
                        initFlatpickr(disabledRanges);
                    })
                    .catch(error => {
                        console.error("Error cargando horarios ocupados:", error);
                        alert(
                            "No se pudieron cargar los horarios del vehículo. Por favor, intenta más tarde."
                            );
                    });
            });
        });
    </script>

    <style>
        .swal-wide {
            width: 400px !important;
            padding: 30px;
        }
    </style>

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
