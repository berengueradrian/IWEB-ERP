<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jornada;
use App\Models\Category;

class UserController extends Controller
{

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
}
