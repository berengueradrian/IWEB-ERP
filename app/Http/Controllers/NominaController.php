<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nomina;

class NominaController extends Controller
{
    // obtener las nominas de un usuario
    public function getNominasUsuario(Request $request) {
        $user = User::whereId($request->user)->first();
        $nominas = $user->nominas()->get();
        $nominas = $nominas->sortBy([["anyo", "desc"], ["mes", "desc"]]);

        // Insertar usuario dentro de las nominas
        foreach ($nominas as $nomina) {
            $nomina->user = $user;
        }

        return response()->json([
            'nominas' => $nominas,
        ]);
    }

    // obtener todas las nominas
    public function getAllNominas() {
        $nominas = Nomina::all();
        $nominas = $nominas->sortBy([["anyo", "desc"], ["mes", "desc"]]);
        
        // Insertar usuario dentro de las nominas
        foreach ($nominas as $nomina) {
            $nomina->user = $nomina->user()->first();
        }

        return response()->json([
            'nominas' => $nominas,
        ]);
    }

    // obtener una nomina
    public function getNomina(Request $request) {
        $nomina = Nomina::whereId($request->nomina)->first();
        $nomina->user = $nomina->user()->first();

        return response()->json([
            'nomina' => $nomina,
        ]);
    }
}
