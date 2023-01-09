<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SupervisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supervisors')->delete();

        $categoriesId = DB::table('categories')->pluck('id');

        DB::table('supervisors')->insert(
        [
            'name' => 'supervisor1',
            'email' => 'super1@ua.es',
            'password' => Hash::make('123'),
            'fecha_nacimiento' => Carbon::parse('1992-05-29'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'category_id' => $categoriesId[1]
        ]);

        DB::table('supervisors')->insert(
        [
            'name' => 'supervisor2',
            'email' => 'super2@ua.es',
            'password' => Hash::make('123'),
            'fecha_nacimiento' => Carbon::parse('1995-11-03'),
            'formacion' => 'Máster en product managemet',
            'image_url' => 'default.jpg',
            'category_id' => $categoriesId[2]
        ]);
    }
}
