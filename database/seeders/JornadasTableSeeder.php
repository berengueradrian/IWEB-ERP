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
    }
}
