<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JornadaTableSeeder extends Seeder
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
        DB::table('jornada')->delete();

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-06-12'),
            'user' => $usersId[0]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 7,
            'hora_salida' => 15,
            'fecha' => Carbon::parse('2022-07-24'),
            'user' => $usersId[1]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-08-17'),
            'user' => $usersId[1]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 7,
            'hora_salida' => 15,
            'fecha' => Carbon::parse('2022-09-15'),
            'user' => $usersId[2]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 6,
            'hora_salida' => 14,
            'fecha' => Carbon::parse('2022-03-04'),
            'user' => $usersId[2]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-02-14'),
            'user' => $usersId[3]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 9,
            'hora_salida' => 17,
            'fecha' => Carbon::parse('2022-10-24'),
            'user' => $usersId[3]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 6,
            'hora_salida' => 14,
            'fecha' => Carbon::parse('2022-07-19'),
            'user' => $usersId[4]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 5,
            'hora_salida' => 13,
            'fecha' => Carbon::parse('2022-09-23'),
            'user' => $usersId[4]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 10,
            'hora_salida' => 18,
            'fecha' => Carbon::parse('2022-03-01'),
            'user' => $usersId[5]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-02-04'),
            'user' => $usersId[5]
        ]);

        DB::table('jornada')->insert(
        [
            'hora_entrada' => 8,
            'hora_salida' => 16,
            'fecha' => Carbon::parse('2022-012-12'),
            'user' => $usersId[6]
        ]);
    }
}
