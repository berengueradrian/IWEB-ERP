<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SolicitudTableSeeder extends Seeder
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
        DB::table('solicitud')->delete();

        DB::table('solicitud')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-12-22'),
            'fecha_fin' => Carbon::parse('2023-01-01'),
            'descripcion' => 'Me voy a París',
            'aceptado' => false,
            'justificante' => NULL,
            'tipo' => 'Vacaciones',
            'user' => $usersId[3]
        ]);

        DB::table('solicitud')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-06-12'),
            'fecha_fin' => Carbon::parse('2022-06-15'),
            'descripcion' => 'Soy bobo',
            'aceptado' => false,
            'justificante' => 'justificante.pdf',
            'tipo' => 'Baja',
            'user' => $usersId[4]
        ]);

        DB::table('solicitud')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-06-12'),
            'fecha_fin' => NULL,
            'descripcion' => 'Quiero un aumento',
            'aceptado' => false,
            'justificante' => NULL,
            'tipo' => 'Otros',
            'user' => $usersId[5]
        ]);

        DB::table('solicitud')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-07-12'),
            'fecha_fin' => Carbon::parse('2022-07-22'),
            'descripcion' => 'A disfrutar',
            'aceptado' => false,
            'justificante' => NULL,
            'tipo' => 'Vacaciones',
            'user' => $usersId[6]
        ]);

        DB::table('solicitud')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-02-12'),
            'fecha_fin' => Carbon::parse('2022-02-14'),
            'descripcion' => 'Resfriado',
            'aceptado' => false,
            'justificante' => 'justificante.pdf',
            'tipo' => 'Baja',
            'user' => $usersId[1]
        ]);

        DB::table('solicitud')->insert(
        [
            'fecha_inicio' => Carbon::parse('2022-05-05'),
            'fecha_fin' => Carbon::parse('2022-05-09'),
            'descripcion' => 'Estoy en cama',
            'aceptado' => false,
            'justificante' => 'justificante.pdf',
            'tipo' => 'Baja',
            'user' => $usersId[2]
        ]);
    }
}
