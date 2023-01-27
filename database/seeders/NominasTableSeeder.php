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

        for($i = 0; $i < 27; $i++) {
            $sueldo = rand(1200, 4500);
            for($j = 0; $j < 12; $j++) {
                for($k = 2021; $k < 2023; $k++) {
                    DB::table('nominas')->insert(
                    [
                        'sueldo' => $sueldo,
                        // month number starting from zero
                        'mes' => $j,
                        'horas' => 40,
                        'horas_extra' => rand(0, 5),
                        'dias_baja' => rand(0, 5),
                        'user_id' => $usersId[$i],
                        'anyo' => $k,
                        'estado' => 1
                    ]);
                }
            }
        }
    }
}
