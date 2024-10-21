<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsController extends Controller {

    public function js_tipo_servicio(){
        return view("modulos.servicios.js_views.jsservicio");
    }


}
