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
        // Delete the table data   
        DB::table('directions')->delete();

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 2',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 3',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 4',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 5',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 6',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 7',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 8',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 9',
        ]);

        DB::table('directions')->insert(
        [
            'name' => 'C/Teulada 10',
        ]);
    }
}
