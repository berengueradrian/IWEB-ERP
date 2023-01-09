<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesId = DB::table('categories')->pluck('id');

        // Delete the table data   
        DB::table('users')->delete();

        $usersId2 = DB::table('supervisors')->pluck('id');

        // Add a new entry to the table 
        DB::table('users')->insert(
        [
            'name' => 'adri',
            'email' => 'adri@ua.es',
            'password' => Hash::make('123'),
            'fecha_nacimiento' => Carbon::parse('2001-01-11'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId2[0],
            'category_id' => $categoriesId[3]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'ilyan',
            'email' => 'ilyan@ua.es',
            'password' => Hash::make('123'),
            'fecha_nacimiento' => Carbon::parse('2001-11-17'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId2[0],
            'category_id' => $categoriesId[3]
        ]);

        $usersId3 = DB::table('users')->pluck('id');

        DB::table('users')->insert(
        [
            'name' => 'rosa',
            'email' => 'rosa@ua.es',
            'password' => Hash::make('123'),
            'fecha_nacimiento' => Carbon::parse('2001-01-10'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId3[1],
            'category_id' => $categoriesId[4]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'javi',
            'email' => 'javi@ua.es',
            'password' => Hash::make('123'),
            'fecha_nacimiento' => Carbon::parse('2001-10-15'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId3[1],
            'category_id' => $categoriesId[4]
        ]);

    }
}
