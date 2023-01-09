<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionUserTableSeeder extends Seeder
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
        $directionsId = DB::table('directions')->pluck('id');

        // Delete the table data   
        DB::table('direction_usuario')->delete();

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[0],
            'directions_id' => $directionsId[0]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[1],
            'directions_id' => $directionsId[1]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[2],
            'directions_id' => $directionsId[2]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[3],
            'directions_id' => $directionsId[3]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $supervisorsId[0],
            'directions_id' => $directionsId[4]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $supervisorsId[1],
            'directions_id' => $directionsId[5]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $adminsId[0],
            'directions_id' => $directionsId[6]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $adminsId[0],
            'directions_id' => $directionsId[7]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $supervisorsId[1],
            'directions_id' => $directionsId[8]
        ]);
    }
}
