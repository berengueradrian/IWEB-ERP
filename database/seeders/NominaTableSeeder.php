<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NominaTableSeeder extends Seeder
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
        DB::table('nomina')->delete();

        DB::table('nomina')->insert(
        [
            'sueldo' => 1500.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user' => $usersId[0]
        ]);

        DB::table('nomina')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user' => $usersId[1]
        ]);

        DB::table('nomina')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user' => $usersId[2]
        ]);

        DB::table('nomina')->insert(
        [
            'sueldo' => 1200.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user' => $usersId[3]
        ]);

        DB::table('nomina')->insert(
        [
            'sueldo' => 1200.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user' => $usersId[4]
        ]);

        DB::table('nomina')->insert(
        [
            'sueldo' => 1200.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user' => $usersId[5]
        ]);

        DB::table('nomina')->insert(
        [
            'sueldo' => 1200.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user' => $usersId[6]
        ]);
    }
}
