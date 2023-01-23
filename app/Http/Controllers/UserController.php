<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Solicitud;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers() {
        $users = User::select('users.id', 'users.name', 'users.email', 'users.admin', 'users.supervisor', 'categories.name as category', 'users.supervisado')
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
        $newUser = User::whereId($request->user)->first();
        return response()->json([
            'user' => $newUser,
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
            'supervisor' => $supervisor,
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

    // obtener las nominas de un usuario
    public function getNominas(Request $request) {
        $user = User::whereId($request->user)->first();
        $nominas = $user->nominas()->get();
        return response()->json([
            'nominas' => $nominas,
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

        if($request->justificante_name == null) {
            $justificante = "No consta";
        }
        else {
            $justificante = $request->justificante_name;
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
            'solicitud' => $solicitud,
        ]);
    }

    // guardar un archivo justificante de una solicitud
    public function saveJustificante(Request $request) {
        if($request->input('justificante')) {
            $archivo = $request->input('justificante');
            Storage::put('public/files/'.$request->justificante_name, $archivo[0]);
            // $file = $request->file('justificante');
            // $name = $request->justificante_name;
            // $file->move(public_path().'../public/files', $name);

            return response()->json([
                'message' => 'Justificante guardado',
                'justificante' => $request->justificante_name,
            ]);
        }
    }

    public function getSolicitudesVacaciones(Request $request) {
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

}
