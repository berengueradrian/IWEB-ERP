<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Solicitud;
use App\Models\Category;
use App\Models\Convenio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function getUsers() {
        $users = User::select('users.id', 'users.name', 'users.email', 'users.fecha_nacimiento', 'users.admin', 'users.image_url', 'users.supervisor', 'categories.name as category', 'users.supervisado')
        ->join('categories', 'users.category_id', '=', 'categories.id')
        ->get();
        return response()->json([
            'data' => $users
        ]);
    }

    public function getSupervisors() {
        $users = User::select('id', 'name')->where('supervisor', '=', '1')->get();
        return response()->json([
            'data' => $users
        ]);
    }

    public function getUser(Request $request) {
        $user = User::select('users.id', 'users.name', 'users.email', 'users.fecha_nacimiento', 'users.admin', 'users.image_url')->whereId($request->user)->first();
        return response()->json([
            'data' => $user,
        ]);
    }

    public function startJornada(Request $request) {
        $user = User::whereId($request->user)->first();
        $jornada =
        $jornada = $user->jornadas()->create([
            'hora_entrada' => now()->hour,
            'hora_salida' => now()->hour,
            'fecha' => now(),
            'user_id' => $user->id,
        ]);
        return response()->json([
            'message' => 'Jornada iniciada',
            'jornada' => $jornada,
        ]);
    }

    public function endJornada(Request $request) {
        $user = User::whereId($request->user)->first();
        $jornada = $user->jornadas()->where('completada', false)->first();
        $jornada->hora_salida = now()->hour;
        $jornada->completada = true;
        $jornada->save();
        return response()->json([
            'message' => 'Jornada finalizada',
            'jornada' => $jornada,
        ]);
    }

    // buscar una jornada activa de un usuario
    public function getJornada(Request $request) {
        $user = User::whereId($request->user)->first();
        $jornada = $user->jornadas()->where('completada', false)->first();
        if($jornada == null) {
            return response()->json([
                'jornada' => true,
            ]);
        }
        return response()->json([
            'jornada' => false,
        ]);
    }

    // obtener el supervisor de un usuario
    public function getSupervisor(Request $request) {
        $user = User::whereId($request->user)->first();
        $supervisor = User::whereId($user->supervisado)->first();
        return response()->json([
            'data' => $supervisor,
        ]);
    }

    // obtener la categoria de un usuario
    public function getCategoria(Request $request) {
        $user = User::whereId($request->user)->first();
        $categoria = Category::whereId($user->category_id)->first();
        return response()->json([
            'categoria' => $categoria,
        ]);
    }


    // obtener las jornadas de un usuario
    public function getJornadas(Request $request) {
        $user = User::whereId($request->user)->first();
        $jornadas = $user->jornadas()->orderBy('id', 'desc')->take(5)->get();
        // $jornadas = $user->jornadas()->get();
        // $jornadas = [];
        // for($i = 0; $i < count($jornadas1) && $i <= 5; $i++) {
        //     array_push($jornadas, $jornadas1[$i]->hora_salida - $jornadas1[$i]->hora_entrada);
        // }

        return response()->json([
            'jornadas' => $jornadas,
        ]);
    }

    // obtener las solicitudes de un usuario
    public function getSolicitudes(Request $request) {
        $user = User::whereId($request->user)->first();
        $solicitudes = $user->solicituds()->get();
        return response()->json([
            'solicitudes' => $solicitudes,
        ]);
    }

    // crear una solicitud por un usuario
    public function createSolicitud(Request $request) {
        $user = User::whereId($request->user)->first();
        $uniqueId = Uuid::uuid4()->toString();

        // $request->validate([
        //     'justificante' => 'max:200*2048',
        // ]);

        if($request->justificante_name == null) {
            $justificante = "No consta";
        }
        else {
            $justificante = $request->justificante_name;
            $path = $request->file('justificante')->storeAs('/files', $request->justificante_name);
            //Storage::put('public/files/'.$request->justificante_name, $request->file('justificante'));
        }

        $solicitud = $user->solicituds()->create([
            'user_id' => $user->id,
            'fecha_inicio' => $request->fecha_inicio,
            'tipo' => $request->tipo,
            'estado' => 0,
            'fecha_fin' => $request->fecha_fin,
            'descripcion' => $request->descripcion,
            'justificante' => $justificante,
        ]);
        return response()->json([
            'message' => 'Solicitud enviada',
            'justificante' => $request->file('justificante'),
            'solicitud' => $solicitud,
        ]);
    }

    // borrar una solicitud de un usuario
    public function deleteSolicitud(Request $request) {
        $user = User::whereId(Auth::guard('api')->user()->id)->first();
        $solicitud = $user->solicituds()->whereId($request->solicitud)->first();
        $solicitud->delete();
        return response()->json([
            'message' => 'Solicitud eliminada',
        ]);
    }

    // guardar un archivo justificante de una solicitud
    public function saveJustificante(Request $request) {
        //if($request->input('justificante')) {
        if($request->hasFile('justificante')) {
            if($request->file('justificante')->isValid()) {
            $archivo = $request->input('justificante');
            $uniqueId = Uuid::uuid4()->toString();
            Storage::put('public/files/'.$request->justificante_name.'-'.$uniqueId, $archivo[0]);
            // $file = $request->file('justificante');
            // $name = $request->justificante_name;
            // $file->move(public_path().'../public/files', $name);

            return response()->json([
                'message' => 'Justificante guardado',
                'justificante' => $request->justificante_name,
            ]);
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El justificante no es válido',
                ], 500);
            }
        }
        else {
            return response()->json([
                'status' => 'error',
                'justificante' => $request->input('justificante'),
                'justificante_name' => $request->justificante_name,
                'header' => $request->headers->get('content-type'),
                'message' => 'La solicitud no tiene justificante',
            ], 500);
        }
    }

    public function getSolicitudesVacaciones(Request $request) {
        if (!Auth::guard('api')->user()->supervisor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
           ], 401);
        }

        $user = User::whereId($request->user)->first();
        $supervisados = User::where('supervisado', $user->id)->get();
        
        $solicitudes = [];
        $usuarios = [];
        foreach($supervisados as $supervisado) {
            $solicituds = $supervisado->solicituds()->where('tipo', 'vacaciones')->get();
            $usuarios[$supervisado->id] = $supervisado->name;
            $size = count($solicituds);
            if($solicituds != null) {
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
            'solicitudesVacaciones' => $solicitudes,
            'usuariosSolicitudes' => $usuarios,
        ]);
    }

    // aprobar una solicitud de vacaciones
    public function aprobarSolicitudVacaciones(Request $request) {
        if (!Auth::guard('api')->user()->supervisor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $solicitud = Solicitud::whereId($request->solicitud)->first();
        $solicitud->estado = 1;
        $solicitud->save();

        return response()->json([
            'message' => 'Solicitud aprobada',
            'solicitud' => $solicitud,
        ]);
    }

    // denegar una solicitud de vacaciones
    public function denegarSolicitudVacaciones(Request $request) {
        if (!Auth::guard('api')->user()->supervisor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $solicitud = Solicitud::whereId($request->solicitud)->first();
        $solicitud->estado = 2;
        $solicitud->save();

        return response()->json([
            'message' => 'Solicitud denegada',
            'solicitud' => $solicitud,
        ]);
    }

    public function createUser(Request $request) {

        $fileName = 'image-' . time();
        if ($request->img_url != 'null') {
            $path = $request->file('img_url')->storeAs('public', $fileName);
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->category_id = $request->category;
        $user->supervisor = $request->role;
        if ($request->supervisor != 'null') {
            $user->supervisado = $request->supervisor;
        }
        $user->password = Hash::make($request->password);
        $user->fecha_nacimiento = $request->birthday;
        $user->image_url = $fileName;
        $user->formacion = $request->formacion;
    
        $user->save();

        $convenio = new Convenio();
        $convenio->horas_diarias = $request->horas_diarias;
        $convenio->sueldo = $request->sueldo;
        $convenio->sueldo_horas_extra = $request->sueldo_horas_extra;
        $convenio->tope_horas_extra = $request->tope_horas_extra;
        $convenio->sueldo_extraordinario = $request->sueldo_extraordinario;
        $convenio->dias_vacaciones = $request->dias_vacaciones;
        $convenio->user_id = $user->id;
        
        $convenio->save();

        return response()->json([
            'message' => 'Usuario creado',
            'data' => $user
        ]);
    }
    
    // obtener el número de horas totales trabajadas por un usuario
    public function getNumeroHoras(Request $request) {
        $user = User::whereId($request->user)->first();
        $jornadas = $user->jornadas()->get();
        $numeroHoras = 0;
        foreach($jornadas as $jornada) {
            $numeroHoras += $jornada->hora_salida - $jornada->hora_entrada;
        }

        return response()->json([
            'numeroHoras' => $numeroHoras,
        ]);
    }

    // obtener el número de compañeros de equipo de un usuario
    public function getNumeroCompaneros(Request $request) {
        $user = User::whereId($request->user)->first();
        $companeros = User::where('supervisado', $user->supervisado)->get();
        $numeroCompaneros = count($companeros) - 1;

        return response()->json([
            'numeroCompaneros' => $numeroCompaneros,
        ]);
    }

    // borrar un usuario
    public function deleteUser(Request $request) {
        $user = User::whereId($request->user)->first();
        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado',
        ]);
    }

}
