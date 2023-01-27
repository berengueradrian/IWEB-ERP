<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JornadasTableSeeder extends Seeder
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
        DB::table('jornadas')->delete();

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-02'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-03'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-04'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-05'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-06'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-09'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-10'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-11'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-12'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-13'),
            'user_id' => $usersId[0],
            'completada' => true
            ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-16'),
            'user_id' => $usersId[0],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-17'),
            'user_id' => $usersId[0],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-18'),
            'user_id' => $usersId[0],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-19'),
            'user_id' => $usersId[0],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2023-01-20'),
            'user_id' => $usersId[0],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
            [
                'hora_entrada' => 8,
                'hora_salida' => 16,
                'fecha' => Carbon::parse('2023-01-23'),
                'user_id' => $usersId[0],
                'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
                'hora_entrada' => 8,
                'hora_salida' => 16,
                'fecha' => Carbon::parse('2023-01-24'),
                'user_id' => $usersId[0],
                'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
                'hora_entrada' => 8,
                'hora_salida' => 18,
                'fecha' => Carbon::parse('2023-01-25'),
                'user_id' => $usersId[0],
                'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
                'hora_entrada' => 8,
                'hora_salida' => 17,
                'fecha' => Carbon::parse('2023-01-26'),
                'user_id' => $usersId[0],
                'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
                'hora_entrada' => 8,
                'hora_salida' => 18,
                'fecha' => Carbon::parse('2023-01-27'),
                'user_id' => $usersId[0],
                'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
                'hora_entrada' => 8,
                'hora_salida' => 19,
                'fecha' => Carbon::parse('2023-01-30'),
                'user_id' => $usersId[0],
                'completada' => true
            ]);

        DB::table('jornadas')->insert(
            [
                'hora_entrada' => 8,
                'hora_salida' => 16,
                'fecha' => Carbon::parse('2023-01-31'),
                'user_id' => $usersId[0],
                'completada' => true
            ]);

        for ($i = 0; $i < 27; $i++) {
            for ($j = 1; $j < 27; $j++) {
                if ($j == 6 || $j == 13 || $j == 20) {
                    $j += 2;
                }
                for ($k = 1; $k < 13; $k++) {
                    if ($i <= 13 && $k == 8) {
                        $k++;
                    }
                    else if ($i > 13 && $k == 7) {
                        $k++;
                    }
                    for ($x = 2021; $x < 2023; $x++) {
                        DB::table('jornadas')->insert(
                        [
                            'hora_entrada' => rand(5, 10),
                            'hora_salida' => rand(13, 19),
                            'fecha' => Carbon::parse($x.'-'.$k.'-'.$j),
                            'user_id' => $usersId[$i],
                            'completada' => true
                        ]);
                    }
                }
            }
        }
    }
}
