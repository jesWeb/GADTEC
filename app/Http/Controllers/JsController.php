<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsController extends Controller {

    public function js_tipo_servicio(Request $request){
        return view("servicios.js_views.js_tipo_servicio");
    }

}
