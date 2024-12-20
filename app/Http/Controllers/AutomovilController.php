<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;

class AutomovilController extends Controller
{
    public function index(Request $request)
    {
        // $cars = Automovil::paginate(10);
        // $cars = Automoviles::all();

        // Inicializar la consulta
        $query = Automoviles::query();

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            // Aplicar la búsqueda a la consulta
            $query->where(function ($q) use ($search) {
                $q->where('marca', 'LIKE', "%{$search}%")
                    ->orWhere('submarca', 'LIKE', "%{$search}%")
                    ->orWhere('modelo', 'LIKE', "%{$search}%")
                    ->orWhere('color', 'LIKE', "%{$search}%")
                    ->orWhere('kilometraje', 'LIKE', "%{$search}%")
                    ->orWhere('placas', 'LIKE', "%{$search}%")
                    ->orWhere('num_serie', 'LIKE', "%{$search}%")
                    ->orWhere('num_motor', 'LIKE', "%{$search}%")
                    ->orWhere('num_nsi', 'LIKE', "%{$search}%");
            });
        }
        $cars = $query->get();
        return view('catalogos.Automovil.index', compact('cars'));
    }

    public function create()
    {
        $AutoC = Automoviles::all();
        // dd($auto);
        return view('catalogos.Automovil.create', compact('AutoC'));
    }
    public function store(Request $request)
    {
        // dd($request);
        //limpieza de comas en kilometraje
        $kilometraje = str_replace(',' , '' , $request->input('kilometraje'));

        $rules = [
            'marca' => 'required|string|max:20',
            'submarca' => 'required|string|max:20',
            'modelo' => [
                'required',
                'integer',
                'min:1990',
                 /*VaLIDACION DE MODELO *
                  *creamos una func persiolaizada
                  donde los atributos de $attribute recibe el parametreo del input y $value -> valor del campo
                  */
                function ($attribute, $value, $fail) {
                    //validamos que el año y mes por parte de la fecha de navegador sean enteros
                    $anioActual = (int) date('Y');
                    $proxMes = (int) date('m');
                    //valida que apartir del 7 mes se registren un ano mas
                    $maxAnio = ($proxMes >= 7) ? $anioActual + 1 : $anioActual;

                    // Validación personalizada del año
                    if ($value < 2000 || $value > $maxAnio) {
                        // Usamos la función $fail para devolver el error
                        $fail("El valor del Modelo debe ser entre 1990 y " . $maxAnio . ".");
                    }
                }
            ],
            'num_serie' => 'required|string|max:20',
            'num_motor' => 'required|string|max:20',
            'capacidad_combustible' => 'nullable|integer',
            'tipo_combustible' => 'required|in:Gasolina,Diésel,Eléctrico',
            'tipo_automovil' => 'required|in:Automovil,Camioneta,Motocicleta',
            'kilometraje' => 'nullable|numeric|min:0',
            'placas' => 'nullable|string|max:10',
            'num_nsi' => 'nullable|string|max:20',
            'uso' => 'nullable|in:Personal,Empresarial',
            'color' => 'nullable|string|max:20',
            'num_puertas' => 'nullable|integer|max:5',
            'estatus' => 'nullable|in:Nuevo,Usado',
            'fecha_registro' => 'nullable|date',
            'responsable' => 'nullable|string|max:50',
            'observaciones' => 'nullable|string|max:255',
            'fotografias' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
        ];
        $message = [
            'modelo.min' => 'El año del modelo debe ser como mínimo 1990 .',
            'modelo.required' => 'El campo Modelo es obligatorio.',
            'modelo.integer' => 'El año del modelo debe ser un número entero.',
        ];

        //limpieza de kilometraje en el req
        $request->merge(['kilometraje' => $kilometraje]);
        //validacion para guardar
        $request->validate($rules, $message);
        $input = $request->all();

        //validacion de las fotos
        if ($request->hasFile('fotografias')) {
            // obtener el campo file definido en el formulario
            $file = $request->file('fotografias');
            // obtener el nombre dek archivo
            $img = $file->getClientOriginalName();
            //obtener fecha y hora
            $ldate = date('Ymd_His_');
            //concatena la fecha y hora con el nombre del Archivo (img)
            $img2 = $ldate . $img;
            //idicamos el nombre  y la ruta donde se almacena el archivo (img)
            $file->move(public_path('img/carros'), $img2);
            $input['fotografias'] = $img2;
        }
        //  return response()->json(['success'=>$img2]);

        Automoviles::create($input);

        return redirect()->route('Automovil.index')->with('mensaje', 'Sea registrado con exito el Automovil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $automovil = Automoviles::findOrFail($id);
        return view('catalogos.Automovil.show', compact('automovil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $EddCar = Automoviles::findOrFail($id);
        return view('catalogos.Automovil.edit', compact('EddCar'));
    }

    public function update(Request $request, $id)
    {
        $EddCar = Automoviles::findOrFail($id);
        $input = $request->all();
        $EddCar->update($input);
        return redirect()->route('Automovil.index')->with('message', 'Se ha modificado correctamente el Registro');
    }

    public function destroy($id)
    {
        $cars = Automoviles::findOrFail($id);
        $cars->delete();
        return redirect()->route('Automovil.index')->with('eliminar', 'Se ha eliminado correctamente El automovil');
    }

    /**
     * Generar reporte de automovil.
     */
    public function generateReport()
    {   // Obtenemos todos los automoviles
        $automoviles = Automoviles::all();
        $pdf = FacadePDF::loadView('catalogos.Automovil.report-automoviles', compact('automoviles'));
        return $pdf->stream();  // Archivo PDF

    }
}
