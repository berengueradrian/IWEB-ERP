<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionsTableSeeder extends Seeder
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
        DB::table('directions')->delete();

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 2',
            'user' => $usersId[0]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 3',
            'user' => $usersId[1]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 4',
            'user' => $usersId[2]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 5',
            'user' => $usersId[3]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 6',
            'user' => $usersId[4]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 7',
            'user' => $usersId[5]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 8',
            'user' => $usersId[5]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 9',
            'user' => $usersId[6]
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 10',
            'user' => $usersId[6]
        ]);
    }
}
