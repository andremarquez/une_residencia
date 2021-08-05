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
        // \App\Models\User::factory(10)->create();

        // para carga toda la data inicial o semilla

        // ejecutar: php artisan db:fresh
        // para limpiar la bases de datos y correr migraciones
        // php artisan db:seed
        $this->call(
            [
                RoleSeeder::class,
                UserSeeder::class,
                ApartamentoSeeder::class,
                DatosBancariosSeeder::class,
                ProveedoresSeeder::class

            ]
        );
    }
}
