<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
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
        // Delete the table data   
        DB::table('users')->delete();

        $faker = Faker::create();
        $categoriesId = DB::table('categories')->pluck('id');

        DB::table('users')->insert(
        [
            'name' => 'admin',
            'email' => 'admin@ua.es',
            'password' => Hash::make('123'),
            'admin' => true,
            'supervisor' => false,
            'fecha_nacimiento' => Carbon::parse('1985-07-24'),
            'formacion' => 'Grado en la universidad de la vida',
            'image_url' => 'default.jpg',
            'supervisado' => NULL,
            'category_id' => $categoriesId[0]
        ]);

        $usersId = DB::table('users')->pluck('id');

        DB::table('users')->insert(
        [
            'name' => 'supervisor1',
            'email' => 'super1@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => true,
            'fecha_nacimiento' => Carbon::parse('1992-05-29'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId[0],
            'category_id' => $categoriesId[1]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'supervisor2',
            'email' => 'super2@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => true,
            'fecha_nacimiento' => Carbon::parse('1995-11-03'),
            'formacion' => 'Máster en product managemet',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId[0],
            'category_id' => $categoriesId[2]
        ]);

        for ($i = 0, $j = 3; $i < 5; $i++, $j++) {
            DB::table('users')->insert(
            [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('123'),
                'admin' => false,
                'supervisor' => true,
                'fecha_nacimiento' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years', $timezone = null),
                'formacion' => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'image_url' => 'default.jpg',
                'supervisado' => $usersId[0],
                'category_id' => $categoriesId[$j]
            ]);
        }

        $usersId2 = DB::table('users')->pluck('id');

        DB::table('users')->insert(
        [
            'name' => 'adri',
            'email' => 'adri@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'fecha_nacimiento' => Carbon::parse('2001-01-11'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId2[1],
            'category_id' => $categoriesId[3]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'ilyan',
            'email' => 'ilyan@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'fecha_nacimiento' => Carbon::parse('2001-11-17'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId2[1],
            'category_id' => $categoriesId[3]
        ]);

        $usersId3 = DB::table('users')->pluck('id');

        DB::table('users')->insert(
        [
            'name' => 'rosa',
            'email' => 'rosa@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'fecha_nacimiento' => Carbon::parse('2001-01-10'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId3[2],
            'category_id' => $categoriesId[4]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'javi',
            'email' => 'javi@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'fecha_nacimiento' => Carbon::parse('2001-10-15'),
            'formacion' => 'Grado en ingeniería informática',
            'image_url' => 'default.jpg',
            'supervisado' => $usersId3[2],
            'category_id' => $categoriesId[4]
        ]);

        for ($i = 0, $j = 3, $k = 9; $i < 15; $i++) {
            DB::table('users')->insert(
            [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('123'),
                'admin' => false,
                'supervisor' => false,
                'fecha_nacimiento' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years', $timezone = null),
                'formacion' => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'image_url' => 'default.jpg',
                'supervisado' => $usersId3[$j],
                'category_id' => $categoriesId[$k]
            ]);
            if($i == 2 || $i == 5 || $i == 8 || $i == 11) {
                $j++;
                $k++;
            }
        }
    }
}
