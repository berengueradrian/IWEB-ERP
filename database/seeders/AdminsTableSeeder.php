<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $categoriesId = DB::table('categories')->pluck('id');

        DB::table('admins')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@ua.es',
                'password' => Hash::make('123'),
                'fecha_nacimiento' => Carbon::parse('1985-07-24'),
                'formacion' => 'Grado en la universidad de la vida',
                'image_url' => 'default.jpg',
                'supervisado' => NULL,
                'category_id' => $categoriesId[0]
            ]);
    }
}
