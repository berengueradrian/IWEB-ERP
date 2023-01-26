<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
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

    // cambiar estado de una nomina
    public function changeEstadoPagado($nominaId, Request $request) {
        $nomina = Nomina::whereId($nominaId)->first();
        $nomina->estado = 1;
        $nomina->save();

        return response()->json([
            'nomina' => $nomina,
        ]);
    }

    // checkear nominas generadas
    public function checkNominasGeneradas(Request $request) {
        $generadas = false;

        $nominas = Nomina::where('anyo', $request->anyo)->where('mes', $request->mes)->get();

        if (count($nominas) > 0) {
            $generadas = true;
        }

        return response()->json([
            'nominasGeneradas' => $generadas,
        ]);
    }

    // generar nominas
    public function generarNominas(Request $request) {
        $convenios = Convenio::all();

        // vamos a ver primero los dias laborables del mes
        $dias_laborables = 0;

        $fecha = $request->anyo . '-' . $request->mes . '-01';
        $dias_del_mes = date('t', strtotime($fecha));

        for ($i = 1; $i <= $dias_del_mes; $i++) {
            $fecha = $request->anyo . '-' . $request->mes . '-' . $i;
            $dia = date('N', strtotime($fecha));

            if ($dia != 6 && $dia != 7) {
                $dias_laborables += 1;
            }
        }

        foreach ($convenios as $convenio) {
            $user = $convenio->user()->first();
            $horas_extra_maximas = $convenio->tope_horas_extra;
            $sueldo_base = $convenio->sueldo;
            $horas_diarias = $convenio->horas_diarias;
            $sueldo_horas_extra = $convenio->sueldo_horas_extra;
            $horas_objetivo = $horas_diarias * $dias_laborables;

            $todas_jornadas_del_mes = $user->jornadas()->get();

            $horas_trabajadas = 0;
            $dias_de_baja_aprobados = 0;

            $solicitudes = $user->solicituds()->where('estado', 1)->where('tipo', 'Baja')->get();

            foreach ($solicitudes as $solicitud) {
                $fecha = $solicitud->fecha_fin;
                $anyo = date('Y', strtotime($fecha));
                $mes = strval(intval(date('m', strtotime($fecha)))); // Para eliminar el 0 delante del mes

                if ($anyo == $request->anyo && $mes == ($request->mes + 1)) {
                    $dias_de_baja_aprobados += date_diff(date_create($solicitud->fecha_fin), date_create($solicitud->fecha_inicio))->days;
                }
            }

            // cuenta de jornadas totales
            $jornadas_totales = 0;

            foreach ($todas_jornadas_del_mes as $jornada) {
                $fecha = $jornada->fecha;
                $anyo = date('Y', strtotime($fecha));
                $mes = strval(intval(date('m', strtotime($fecha)))); // Para eliminar el 0 delante del mes

                if ($anyo == $request->anyo && $mes == ($request->mes + 1) && $jornada->completada) {
                    $jornadas_totales += 1;
                    $horas_trabajadas += $jornada->hora_salida - $jornada->hora_entrada;
                }
            }

            // El numero de jornadas totales deberia ser igual al numero de dias laborables del mes
            $diferencia_dias = $dias_laborables - $jornadas_totales;

            if ($diferencia_dias > 0) {
                // quiere decir que ha faltado algun dia
                // comprobamos que no se haya pasado de los dias de baja solicitados
                if ($dias_de_baja_aprobados < $diferencia_dias) {
                    // por cada dia de baja no aprobado se le descuentan horas extra
                    $sueldo_base -= (($diferencia_dias - $dias_de_baja_aprobados) * $horas_diarias) * $sueldo_horas_extra;
                    // por cada dia de baja aprobado se le descuentan horas trabajadas normales
                    $sueldo_base -= ($dias_de_baja_aprobados * $horas_diarias) * ($sueldo_base / $horas_objetivo);
                } else {
                    // por cada dia de baja aprobado se le descuentan horas trabajadas normales
                    $sueldo_base -= ($diferencia_dias * $horas_diarias) * ($sueldo_base / $horas_objetivo);
                }
            }

            // calculamos las horas extra

            $horas_esperadas_contando_bajas = $jornadas_totales * $horas_diarias;
            $horas_extra = $horas_trabajadas - $horas_esperadas_contando_bajas;

            if ($horas_extra > $horas_extra_maximas) {
                $horas_extra = $horas_extra_maximas;
            } elseif ($horas_extra < 0) {
                $horas_extra = 0;
            }

            $sueldo_horas_extra = $horas_extra * $sueldo_horas_extra;

            $sueldo_total = $sueldo_base + $sueldo_horas_extra;

            if ($sueldo_total < 0) {
                $sueldo_total = 0;
            }

            $nomina = new Nomina();
            $nomina->anyo = $request->anyo;
            $nomina->mes = $request->mes;
            $nomina->sueldo = $convenio->sueldo;
            $nomina->user_id = $user->id;
            $nomina->horas = $horas_esperadas_contando_bajas;
            $nomina->horas_extra = $horas_extra;
            $nomina->dias_baja = $dias_de_baja_aprobados;
            $nomina->importe_horas_extra = $sueldo_horas_extra;
            $nomina->importe_dias_baja = $sueldo_total - $sueldo_horas_extra - $convenio->sueldo;
            $nomina->importe_total = $sueldo_total;
            $nomina->jornadas_trabajadas = $jornadas_totales;
            $nomina->jornadas_esperadas = $dias_laborables;
            $nomina->estado = 0;
            $nomina->save();
        }

        return response()->json([
            'nominasGeneradas' => true,
        ]);
    }
}
