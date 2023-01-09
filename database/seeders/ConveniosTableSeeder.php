<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConveniosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersId = DB::table('users')->pluck('id');
        $supervisorsId = DB::table('supervisors')->pluck('id');
        $adminsId = DB::table('admins')->pluck('id');

        // Delete the table data   
        DB::table('convenios')->delete();

        DB::table('convenios')->insert(
        [
            'sueldo' => 1500.99,
            'horas_diarias' => 8,
            'sueldo_horas_extra' => 16.99,
            'tope_horas_extra' => 15,
            'sueldo_extraordinario' => 22.99,
            'dias_vacaciones' => 15,
            'user_id' => $usersId[0]
        ]);

        DB::table('convenios')->insert(
        [
            'sueldo' => 1900.99,
            'horas_diarias' => 8,
            'sueldo_horas_extra' => 18.99,
            'tope_horas_extra' => 15,
            'sueldo_extraordinario' => 24.99,
            'dias_vacaciones' => 15,
            'user_id' => $usersId[1]
        ]);

        DB::table('convenios')->insert(
        [
            'sueldo' => 1900.99,
            'horas_diarias' => 8,
            'sueldo_horas_extra' => 18.99,
            'tope_horas_extra' => 15,
            'sueldo_extraordinario' => 24.99,
            'dias_vacaciones' => 15,
            'user_id' => $usersId[2]
        ]);

        DB::table('convenios')->insert(
        [
            'sueldo' => 12000.99,
            'horas_diarias' => 8,
            'sueldo_horas_extra' => 14.99,
            'tope_horas_extra' => 15,
            'sueldo_extraordinario' => 20.99,
            'dias_vacaciones' => 15,
            'user_id' => $usersId[3]
        ]);

        DB::table('convenios')->insert(
        [
            'sueldo' => 1200.99,
            'horas_diarias' => 8,
            'sueldo_horas_extra' => 14.99,
            'tope_horas_extra' => 15,
            'sueldo_extraordinario' => 20.99,
            'dias_vacaciones' => 15,
            'user_id' => $supervisorsId[0]
        ]);

        DB::table('convenios')->insert(
        [
            'sueldo' => 1200.99,
            'horas_diarias' => 8,
            'sueldo_horas_extra' => 14.99,
            'tope_horas_extra' => 15,
            'sueldo_extraordinario' => 20.99,
            'dias_vacaciones' => 15,
            'user_id' => $supervisorsId[1]
        ]);

        DB::table('convenios')->insert(
        [
            'sueldo' => 1200.99,
            'horas_diarias' => 8,
            'sueldo_horas_extra' => 14.99,
            'tope_horas_extra' => 15,
            'sueldo_extraordinario' => 20.99,
            'dias_vacaciones' => 15,
            'user_id' => $adminsId[0]
        ]);
    }
}
