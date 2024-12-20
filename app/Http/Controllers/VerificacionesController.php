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

        $sql = "SELECT
        ver.id_verificacion,
        ver.fecha_verificacion,
        ver.proxima_verificacion,
        CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil
        FROM
             verificacions as ver
        JOIN
            automoviles AS aut ON ver.id_automovil = aut.id_automovil
        WHERE
         ver.deleted_at IS NULL";

        // Condiciones dinámicas para búsqueda
        $conditions = [];
        $parameters = [];

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $conditions[] = "(ver.id_verificacion LIKE :search1 OR
                             ver.fecha_verificacion LIKE :search2 OR
                             ver.proxima_verificacion LIKE :search3 OR
                             aut.marca LIKE :search4 OR
                             aut.submarca LIKE :search5 OR
                             aut.modelo LIKE :search6)";
            $parameters = [
                'search1' => "%{$search}%",
                'search2' => "%{$search}%",
                'search3' => "%{$search}%",
                'search4' => "%{$search}%",
                'search5' => "%{$search}%",
                'search6' => "%{$search}%"
            ];
        }

        // Si hay condiciones de búsqueda, agregar al WHERE
        if (!empty($conditions)) {
            $sql .= " AND " . implode(' AND ', $conditions);
        }
        // Ejecutar la consulta SQL
        $verificacion = \DB::select($sql, $parameters);
        return view('catalogos.verificaciones.index', compact('verificacion'));
    }

    public function create()
    {
        $automoviles = Automoviles::all();
        return view('catalogos.verificaciones.create', compact('automoviles'));
    }


    public function store(Request $request)
    {
        // dd($request);
        // Validar entrada básica
        $request->validate([
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'engomado' => 'required|in:Verde,Amarillo,Rosa,Rojo,Azul',
            'fecha_verificacion' => 'nullable|date|before_or_equal:today',
            'holograma' => 'required|in:0,00,1,2',
            'estadoV' => 'required|in:EdoMex,Morelos,CDMX',
            'observaciones' => 'nullable|string',
            'image' => 'nullable|array|max:10',
            'image.*' => 'file|mimes:jpg,png,jpeg',
        ]);

        // Obtener el valor del engomado y la fecha
        $engomado = $request->input('engomado');
        // Usar Carbon para manipular fechas
        $fechaV = Carbon::parse($request->input('fecha_verificacion'));
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

        //verificar si es 00
        $hologramaOpc = $request->input('holograma');

        if ($hologramaOpc == '00') {
            $fechaV = null;
            $proximaVerificacion = null;

            //fecha a 00 dese el input
            $fechaVerificacion = Carbon::parse($request->input('fecha_verificacion'));
            $proximaVerificacion = $fechaVerificacion->copy()->addYears(2);

        } elseif (in_array($hologramaOpc,['0','1','2'])   ) {
            $fechaVerificacion = $fechaV->copy()->addMonths(6);
            $proximaVerificacion = $fechaVerificacion;
        }else{
            $proximaVerificacion = null;
            // $proximaVerificacion00 = null;
        }

        //guardar fotos
        $fotografias = [];
        $maxTotalSize = 50 * 1024 * 1024; // 50 MB
        $totalSize = 0;

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                // Guardar el archivo en el directorio público
                $imgVerificacion = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/verificaciones'), $imgVerificacion);
                $fotografias[] = $imgVerificacion;
            }
        }

        //$input Guardar en json la imagen
        $input['image'] = json_encode($fotografias);

        // Guardar la verificación
        Verificacion::create([
            'id_automovil' => $request->input('id_automovil'),
            'engomado' => $engomado,
            'holograma' => $request->input('holograma'),
            'fecha_verificacion' => $hologramaOpc == '00' ? null : ($fechaV ? $fechaV->format('Y-m-d') : null),
            'proxima_verificacion' => $hologramaOpc == '00' ? null : ($proximaVerificacion ? $proximaVerificacion->format('Y-m-d') : null),
            'observaciones' => $request->input('observaciones'),
            'image' => $input['image'],
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

        // Obtener la verificación existente
        $EddVer = Verificacion::findOrFail($id);

        // Obtener los valores de la solicitud y el engomado
        $engomado = $request->input('engomado');
        $fechaV = Carbon::parse($request->input('fechaV'));
        $mes = $fechaV->month;

        // Definir los rangos de meses según el engomado
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

        // Verificar si el semestre es válido
        if (!$semestre) {
            return back()->withErrors([
                'fechaV' => 'La fecha seleccionada no corresponde al engomado seleccionado.'
            ])->withInput();
        }

        // Verificar si es un caso de 'etiqueta_00'
        $etiquetaDobleCero = $request->input('etiqueta_00');
        if ($etiquetaDobleCero) {
            $fechaV = null;
            $proximaVerificacion = null;
            $fechaVerificacionCero = Carbon::parse($request->input('fecha_verificacion_00'));
            $proximaVerificacion00 = $fechaVerificacionCero->copy()->addYears(2);

            $motivoCero = $request->input('motivo_00');
        } else {
            $proximaVerificacion = $fechaV->copy()->addMonths(6);
            $proximaVerificacion00 = null;

            $motivoCero = null;
        }

        // Manejo de imágenes
        // $fotografias = $EddVer->image ? json_decode($EddVer->image, true) : [];
        $fotografias = $EddVer->image ? json_decode($EddVer->image, true) : [];

        $maxTotalSize = 50 * 1024 * 1024; // 50 MB
        $totalSize = 0;

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                // Guardar el archivo en el directorio público
                $imgVerificacion = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/verificaciones'), $imgVerificacion);
                $fotografias[] = $imgVerificacion;
            }
        }


        // Actualizar el registro en la base de datos
        $input = $request->all();
        $input['image'] = json_encode($fotografias);

        $EddVer->update([
            'id_automovil' => $input['id_automovil'],
            'engomado' => $input['engomado'],
            'holograma' => $input['holograma'],
            'fecha_verificacion' => $etiquetaDobleCero ? null : ($fechaV ? $fechaV->format('Y-m-d') : null),
            'proxima_verificacion' => $etiquetaDobleCero ? null : ($proximaVerificacion ? $proximaVerificacion->format('Y-m-d') : null),
            'observaciones' => $input['observaciones'],
            'image' => $input['image'],
            'motivo_00' => $motivoCero,
            'fecha_verificacion_00' => $etiquetaDobleCero ? $fechaVerificacionCero->format('Y-m-d') : null,
            'proxima_verificacion_00' => $etiquetaDobleCero ? $proximaVerificacion00->format('Y-m-d') : null
        ]);

        return redirect()->route('verificaciones.index')->with('message', "Se ha actualizado correctamente el registro");
    }
    public function destroy($id)
    {
        $DelVer = verificacion::findOrFail($id);
        $DelVer->delete();
        return redirect()->route('verificaciones.index')->with('eliminar', 'Se ha eliminado el registro');
    }
}
