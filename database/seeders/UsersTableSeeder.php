<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesId = DB::table('category')->pluck('id');

        // Delete the table data   
        DB::table('users')->delete();

        $usersId = DB::table('users')->pluck('id');
        
        DB::table('users')->insert(
        [
            'name' => 'admin',
            'email' => 'admin@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'imgage_url' => 'default.jpg',
            'supervisado' => ,
            'category_id' => $categoriesId[0]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'supervisor1',
            'email' => 'super1@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'imgage_url' => 'default.jpg',
            'supervisado' => ,
            'category_id' => $categoriesId[1]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'supervisor2',
            'email' => 'super2@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'imgage_url' => 'default.jpg',
            'supervisado' => ,
            'category_id' => $categoriesId[2]
        ]);

        // Add a new entry to the table 
        DB::table('users')->insert(
        [
            'name' => 'adri',
            'email' => 'adri@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'imgage_url' => 'default.jpg',
            'supervisado' => ,
            'category_id' => $categoriesId[3]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'ilyan',
            'email' => 'ilyan@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'imgage_url' => 'default.jpg',
            'supervisado' => ,
            'category_id' => $categoriesId[3]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'rosa',
            'email' => 'rosa@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'imgage_url' => 'default.jpg',
            'supervisado' => ,
            'category_id' => $categoriesId[4]
        ]);

        DB::table('users')->insert(
        [
            'name' => 'javi',
            'email' => 'javi@ua.es',
            'password' => Hash::make('123'),
            'admin' => false,
            'supervisor' => false,
            'imgage_url' => 'default.jpg',
            'supervisado' => ,
            'category_id' => $categoriesId[4]
        ]);

    }
}
