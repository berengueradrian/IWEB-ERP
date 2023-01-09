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
        DB::table('categories')->delete();

        // Add a new entry to the table 
        DB::table('categories')->insert(
        [
            'name' => 'RRHH'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Director de desarrollo'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Director de producto'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Desarrollo'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Producto'
        ]);
    }
}
