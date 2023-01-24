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
            'name' => 'Director de Desarrollo'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Director de Producto'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Director de Marketing'
        ]);
    
        DB::table('categories')->insert(
        [
            'name' => 'Director de Diseño'
        ]);
    
        DB::table('categories')->insert(
        [
            'name' => 'Director de RRPP'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Director de Finanzas'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Director de RRII'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Desarrollo'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Producto'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Marketing'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Diseño'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'RRPP'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'Finanzas'
        ]);

        DB::table('categories')->insert(
        [
            'name' => 'RRII'
        ]);
    }
}
