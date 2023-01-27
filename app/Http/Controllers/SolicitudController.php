<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitud;

class SolicitudController extends Controller
{

    //todas las solicitudes recibidas por el administrador
    public function getSolicitudesAdmin(Request $request) {

        if (!Auth::guard('api')->user()->admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $solicitudes = Solicitud::all();

        foreach ($solicitudes as $solicitud) {
            $solicitud->user = $solicitud->user()->first();
            
            if ($solicitud->estado == 0) {
                $solicitud->estado = "Pendiente";
            } else if ($solicitud->estado == 1) {
                $solicitud->estado = "Aprobada";
            } else if ($solicitud->estado == 2) {
                $solicitud->estado = "Denegada";
            }
        }

        $return_array = array();

        foreach ($solicitudes as $solicitud) {
            if ($solicitud->tipo == "Vacaciones") {
                if ($solicitud->user->supervisado == null) {
                    array_push($return_array, $solicitud);
                }
            } else {
                array_push($return_array, $solicitud);
            }
        }

        return response()->json([
            'solicitudes' => $solicitudes,
        ]);
    }

}
