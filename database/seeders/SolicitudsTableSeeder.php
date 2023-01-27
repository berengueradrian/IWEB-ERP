<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

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
        $faker = Faker::create();

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
                'fecha_inicio' => Carbon::parse('2023-01-02'),
                'fecha_fin' => Carbon::parse('2023-01-03'),
                'descripcion' => 'Soy bobo',
                'estado' => 1,
                'justificante' => 'justificante.pdf',
                'tipo' => 'Baja',
                'user_id' => '1'
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

        for ($i = 0; $i < 35; $i++) {
            DB::table('solicituds')->insert(
            [
                'fecha_inicio' => Carbon::parse('2021-'.rand(1, 12).'-'.rand(1, 28)),
                'fecha_fin' => Carbon::parse('2022-'.rand(1, 12).'-'.rand(1, 28)),
                'descripcion' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'estado' => rand(0,2),
                'justificante' => 'No consta',
                'tipo' => $faker->randomElement(['Baja', 'Otros']),
                'user_id' => $usersId[rand(1, 26)]
            ]);
        }

        for ($i = 0; $i < 27; $i++) {
            $mes = ($i <= 13) ? 7 : 8;
            for ($k = 2021; $k < 2023; $k++) {
                DB::table('solicituds')->insert(
                [
                    'fecha_inicio' => Carbon::parse($k.'-'.$mes.'-'.'1'),
                    'fecha_fin' => Carbon::parse($k.'-'.$mes.'-'.'28'),
                    'descripcion' => 'Vacaciones de verano',
                    'estado' => 1,
                    'justificante' => 'No consta',
                    'tipo' => 'Vacaciones',
                    'user_id' => $usersId[$i]
                ]);
            }
        }
    }
}
