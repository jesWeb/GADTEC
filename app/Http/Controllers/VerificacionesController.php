<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\verificacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificacionesController extends Controller
{

    public function index(Request $request)
    {

        $query = verificacion::with('automovil');
        // Verificar si hay una búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('id_automovil', 'LIKE', "%{$search}%")
                    ->orWhere('holograma', 'LIKE', "%{$search}%")
                    ->orWhere('engomado', 'LIKE', "%{$search}%")
                    ->orWhere('fechaV', 'LIKE', "%{$search}%")
                    ->orWhereHas('automovil', function ($q) use ($search) {
                        $q->where('marca', 'LIKE', "%{$search}%")
                            ->orWhere('submarca', 'LIKE', "%{$search}%")
                            ->orWhere('modelo', 'LIKE', "%{$search}%");
                    });
            });
        }
        $verificacion = $query->get();
        return view('catalogos.verificaciones.index', compact('verificacion'));
    }
    public function create()
    {
        $automoviles = Automoviles::all();
        return view('catalogos.verificaciones.create', compact('automoviles'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'etiqueta_00' => $request->has('etiqueta_00') ? true : false
        ]);

        // Validar entrada básica
        $request->validate([
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'engomado' => 'required|in:Verde,Amarillo,Rosa,Rojo,Azul',
            'fechaV' => 'nullable|date|before_or_equal:today',
            'holograma' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'image' => 'nullable|array|max:5',
            'image.*' => 'file|mimes:jpg,png,jpeg|max:10240',
            'etiqueta_00' => 'nullable|boolean',
            'motivo_00' => 'nullable|string|max:255',
            'fecha_verificacion_00' => 'nullable|date|before_or_equal:today',
        ]);

        // Obtener el valor del engomado y la fecha
        $engomado = $request->input('engomado');
        // Usar Carbon para manipular fechas
        $fechaV = Carbon::parse($request->input('fechaV'));
        $mes = $fechaV->month;

        // Definir rangos de meses según el engomado
        $rangos = [
            'Amarillo' => [
                'primer' => [1, 2], // Enero, Febrero
                'segundo' => [7, 8] // Julio, Agosto
            ],
            'Rosa' => [
                'primer' => [2, 3], // Febrero, Marzo
                'segundo' => [8, 9] // Agosto, Septiembre
            ],
            'Rojo' => [
                'primer' => [3, 4], // Marzo, Abril
                'segundo' => [9, 10] // Septiembre, Octubre
            ],
            'Verde' => [
                'primer' => [4, 5], // Abril, Mayo
                'segundo' => [10, 11] // Octubre, Noviembre
            ],
            'Azul' => [
                'primer' => [5, 6], // Mayo, Junio
                'segundo' => [11, 12] // Noviembre, Diciembre
            ],
        ];

        // Determinar semestre válido
        $semestre = null;
        if (in_array($mes, $rangos[$engomado]['primer'])) {
            $semestre = 'primer';
        } elseif (in_array($mes, $rangos[$engomado]['segundo'])) {
            $semestre = 'segundo';
        }

        // Si no encuentra un semestre válido, regresar el error
        if (!$semestre) {
            return back()->withErrors([
                'fechaV' => 'La fecha seleccionada no corresponde al engomado seleccionado.'
            ])->withInput();
        }

        // Calcular la próxima fecha de verificación sumando 6 meses
        // $proximaVerificacion = $fechaV->copy()->addMonths(6);

        //verificar si es 00
        $etiquetaDobleCero = $request->input('etiqueta_00');
        if ($etiquetaDobleCero) {
            $fechaV = null;
            $proximaVerificacion = null;
            // Obtener fecha  verificación ingresada por el usuario
            $fechaVerificacionCero = Carbon::parse($request->input('fecha_verificacion_00'));
            //  sumando 2 años a la fecha de verificación 00
            $proximaVerificacion00 = $fechaVerificacionCero->copy()->addYears(2);

            $motivoCero = $request->input('motivo_00');
        } else {
            //si no es 00 suma los 6b meses normales
            $proximaVerificacion = $fechaV->copy()->addMonths(6);
            $proximaVerificacion00 = null;

            $motivoCero = null;
        }


        //guardar fotografias
        $fotografias = [];

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            //limitar a 5
            $files = array_slice($files, 0, 5);
            foreach ($request->file('image') as $file) {
                $imgVeri = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/verificaciones'), $imgVeri);
                $fotografias[] = $imgVeri;
            }
        }

        //guardar en json la img
        $input['image'] = json_encode($fotografias);

        // Guardar la verificación
        Verificacion::create([
            'id_automovil' => $request->input('id_automovil'),
            'engomado' => $engomado,
            'holograma' => $request->input('holograma'),
            'fecha_verificacion' => $etiquetaDobleCero ? null : ($fechaV ? $fechaV->format('Y-m-d') : null),
            'proxima_verificacion' => $etiquetaDobleCero ? null : ($proximaVerificacion ? $proximaVerificacion->format('Y-m-d') : null),
            'observaciones' => $request->input('observaciones'),
            'image' => $input['image'],
            'motivo_00' => $motivoCero,
            'fecha_verificacion_00' => $etiquetaDobleCero ? $fechaVerificacionCero->format('Y-m-d') : null,
            'proxima_verificacion_00' => $etiquetaDobleCero ? $proximaVerificacion00->format('Y-m-d') : null
        ]);

        return redirect()->route('verificaciones.index')->with('mensaje', 'Se ha registrado correctamente el registro');
    }




    public function show($id)
    {
        $MostrarVer = verificacion::findOrfail($id);
        return view('catalogos.verificaciones.show', compact('MostrarVer'));
    }

    public function edit(string $id)
    {
        $EddVer = verificacion::find($id);
        $automoviles = Automoviles::all();
        return view('catalogos.verificaciones.edit', compact('EddVer', 'automoviles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $ultimaFecha = \Carbon\Carbon::parse($validatedData['fechaV']);
        $proximaV = $ultimaFecha->addMonths(6);
        $input['fechaP'] = $proximaV->format('Y-m-d');

        $EddVer = verificacion::findOrFail($id);
        $input = $request->all();
        $EddVer->update($input);

        return redirect()->route('verificaciones.index')->with('message', "Se ha actualizado correctamente el registro");
    }

    public function destroy($id)
    {
        //
        $DelVer = verificacion::findOrFail($id);
        $DelVer->delete();
        return redirect()->route('verificaciones.index')->with('eliminar', 'Se ha eliminado el registro');
    }
}
