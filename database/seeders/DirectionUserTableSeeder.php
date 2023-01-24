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
            'user_id' => $usersId[4],
            'directions_id' => $directionsId[4]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[5],
            'directions_id' => $directionsId[5]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[6],
            'directions_id' => $directionsId[6]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[6],
            'directions_id' => $directionsId[7]
        ]);

        DB::table('direction_usuario')->insert(
        [
            'user_id' => $usersId[5],
            'directions_id' => $directionsId[8]
        ]);

        // add relations between all the directions and all users with each user has 2 directions at least
        for ($i = 7, $j = 9; $i < 27; $i++, $j++) {
            DB::table('direction_usuario')->insert(
            [
                'user_id' => $usersId[$i],
                'directions_id' => $directionsId[$j]
            ]);
        }

    }
}
