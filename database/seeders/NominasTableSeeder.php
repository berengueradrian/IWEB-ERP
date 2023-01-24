<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class NominasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersId = DB::table('users')->pluck('id');
        $faker = Faker::create('es_ES');

        // Delete the table data   
        DB::table('nominas')->delete();

        DB::table('nominas')->insert(
        [
            'sueldo' => 1500.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[0]
        ]);

        DB::table('nominas')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[1]
        ]);

        DB::table('nominas')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[2]
        ]);

        DB::table('nominas')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[3]
        ]);

        DB::table('nominas')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[4]
        ]);

        DB::table('nominas')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[5]
        ]);

        DB::table('nominas')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[6]
        ]);

        DB::table('nominas')->insert(
        [
            'sueldo' => 1900.99,
            'mes' => 'Enero',
            'horas' => 40,
            'horas_extra' => 0,
            'dias_baja' => 0,
            'user_id' => $usersId[7]
        ]);

        for($i = 0; $i < 30; $i++) {
            DB::table('nominas')->insert(
            [
                'sueldo' => 1200.99,
                'mes' => $faker->monthName,
                'horas' => 40,
                'horas_extra' => rand(0, 5),
                'dias_baja' => rand(0, 5),
                'user_id' => $usersId[rand(8,26)]
            ]);
        }
    }
}
