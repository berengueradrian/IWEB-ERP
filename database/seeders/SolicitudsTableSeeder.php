<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SolicitudsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersId = DB::table('users')->pluck('id');

        // Delete the table data   
        DB::table('solicituds')->delete();

        DB::table('solicituds')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-12-22'),
            'fecha_fin' => Carbon::parse('2023-01-01'),
            'descripcion' => 'Me voy a París',
            'estado' => 0,
            'justificante' => NULL,
            'tipo' => 'Vacaciones',
            'user_id' => $usersId[3]
        ]);

        DB::table('solicituds')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-06-12'),
            'fecha_fin' => Carbon::parse('2022-06-15'),
            'descripcion' => 'Soy bobo',
            'estado' => 0,
            'justificante' => 'justificante.pdf',
            'tipo' => 'Baja',
            'user_id' => $usersId[4]
        ]);

        DB::table('solicituds')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-06-12'),
            'fecha_fin' => NULL,
            'descripcion' => 'Quiero un aumento',
            'estado' => 0,
            'justificante' => NULL,
            'tipo' => 'Otros',
            'user_id' => $usersId[5]
        ]);

        DB::table('solicituds')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-07-12'),
            'fecha_fin' => Carbon::parse('2022-07-22'),
            'descripcion' => 'A disfrutar',
            'estado' => 0,
            'justificante' => NULL,
            'tipo' => 'Vacaciones',
            'user_id' => $usersId[6]
        ]);

        DB::table('solicituds')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-02-12'),
            'fecha_fin' => Carbon::parse('2022-02-14'),
            'descripcion' => 'Resfriado',
            'estado' => 0,
            'justificante' => 'justificante.pdf',
            'tipo' => 'Baja',
            'user_id' => $usersId[1]
        ]);

        DB::table('solicituds')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-05-05'),
            'fecha_fin' => Carbon::parse('2022-05-09'),
            'descripcion' => 'Estoy en cama',
            'estado' => 0,
            'justificante' => 'justificante.pdf',
            'tipo' => 'Baja',
            'user_id' => $usersId[2]
        ]);
    }
}
