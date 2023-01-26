<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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


        $usuarios = User::select('users.id', 'users.name', 'users.email')->where('admin', 0)->get();
        
        $solicitudes = [];
        $usuarios_con_solicitud = [];

        // añado todas las solicitudes que son de tipo OTROS
        // añado todas las solicitudes que son de tipo BAJAS
        // añado todas las solicitudes que son de tipo VACACIONES si el usuario NO TIENE SUPERVISOR

        foreach($usuarios as $user) {

            if ($user->supervisado() == null){
                $solicituds = $user->solicituds()->get();
            }
            else{   //ya tiene un supervisor que va a ver las solicitudes de vacaciones
                $solicituds = $user->solicituds()->where('tipo', '!=', 'vacaciones')->get();
            }

            $usuarios_con_solicitud[$user->id] = $user->id;
            $size = count($solicituds);
            if($size > 0) {
                if($size > 1) {
                    for($i = 0; $i < $size; $i++) {
                        array_push($solicitudes, $solicituds[$i]);
                    }
                }
                else {
                    array_push($solicitudes, $solicituds[0]);
                }
            }
        }

        return response()->json([
            'usuarios' => $usuarios_con_solicitud,
            'solicitudes' => $solicitudes,
        ]);


    }

}
