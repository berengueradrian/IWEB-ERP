<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-06-12'),
            'user_id' => $usersId[0],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 7,
            'hora_salida' => 15,
            'fecha' => Carbon::parse('2022-07-24'),
            'user_id' => $usersId[1],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-08-17'),
            'user_id' => $usersId[1],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 7,
            'hora_salida' => 15,
            'fecha' => Carbon::parse('2022-09-15'),
            'user_id' => $usersId[2],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 6,
            'hora_salida' => 14,
            'fecha' => Carbon::parse('2022-03-04'),
            'user_id' => $usersId[2],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-02-14'),
            'user_id' => $usersId[3],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 9,
            'hora_salida' => 17,
            'fecha' => Carbon::parse('2022-10-24'),
            'user_id' => $usersId[3],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 6,
            'hora_salida' => 14,
            'fecha' => Carbon::parse('2022-07-19'),
            'user_id' => $usersId[4],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 5,
            'hora_salida' => 13,
            'fecha' => Carbon::parse('2022-09-23'),
            'user_id' => $usersId[4],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 10,
            'hora_salida' => 18,
            'fecha' => Carbon::parse('2022-03-01'),
            'user_id' => $usersId[5],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-02-04'),
            'user_id' => $usersId[5],
            'completada' => true
        ]);

        DB::table('jornadas')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-12-12'),
            'user_id' => $usersId[6],
            'completada' => true
        ]);

        for ($i = 0; $i < 60; $i++) {
            DB::table('jornadas')->insert(
            [
                'hora_entrada' => rand(5, 10),
                'hora_salida' => rand(13, 19),
                'fecha' => Carbon::parse(rand(2021, 2022).'-'.rand(1, 12).'-'.rand(1, 28)),
                'user_id' => $usersId[rand(0, 26)],
                'completada' => true
            ]);
        }
    }
}
