<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete the table data   
        DB::table('category')->delete();

        // Add a new entry to the table 
        DB::table('category')->insert(
        [
            'name' => 'RRHH'
        ]);

        DB::table('category')->insert(
        [
            'name' => 'Director de desarrollo'
        ]);

        DB::table('category')->insert(
        [
            'name' => 'Director de producto'
        ]);

        DB::table('category')->insert(
        [
            'name' => 'Desarrollo'
        ]);

        DB::table('category')->insert(
        [
            'name' => 'Producto'
        ]);
    }
}
