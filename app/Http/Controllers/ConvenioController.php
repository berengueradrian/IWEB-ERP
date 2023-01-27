<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;

class ConvenioController extends Controller
{
    // ruta para modificar un convenio y actualizarlo
    public function updateConvenio($convenioId, Request $request) {
        $convenio = Convenio::find($convenioId);
        
        $convenio->sueldo = $request->sueldo;
        $convenio->horas_diarias = $request->horas_diarias;
        $convenio->sueldo_horas_extra = $request->sueldo_horas_extra;
        $convenio->tope_horas_extra = $request->tope_horas_extra;
        $convenio->sueldo_extraordinario = $request->sueldo_extraordinario;
        $convenio->dias_vacaciones = $request->dias_vacaciones;
        $convenio->save();

        return response()->json([
            'convenio' => $convenio
        ]);
    }
}
