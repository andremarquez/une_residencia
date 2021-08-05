<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                'id' => Role::ROL_ADMIN,
                'name' => 'Administrador'
            ]
        );

        DB::table('roles')->insert(
            [
                'id' => Role::ROL_TESORERO,
                'name' => 'Tesorero'
            ]
        );
        DB::table('roles')->insert(
            [
                'id' => Role::ROL_PROPIETARIO,
                'name' => 'Propietario'
            ]
        );
    }
}
