<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->command->info('Category table seeded!');
        $this->call(UsersTableSeeder::class);
        $this->command->info('User table seeded!');
        $this->call(ConvenioTableSeeder::class);
        $this->command->info('Convenio table seeded!');
        $this->call(DirectionsTableSeeder::class);
        $this->command->info('Direction table seeded!');
        $this->call(JornadaTableSeeder::class);
        $this->command->info('Jornada table seeded!');
        $this->call(NominaTableSeeder::class);
        $this->command->info('Nomina table seeded!');
        $this->call(SolicitudTableSeeder::class);
        $this->command->info('Solicitud table seeded!');
        $this->call(DirectionUserTableSeeder::class);
        $this->command->info('DirectionUser table seeded!');
    }
}
