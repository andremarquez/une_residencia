<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insertando data semilla o inicial
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'admin@residencia.com',
            'password' => Hash::make('12345678'),
            'ci' => 'V-454545',
            'phone' => '1234546',
            'role_id' => Role::ROL_ADMIN,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'first_name' => 'Test',
            'last_name' => 'Tesorero',
            'email' => 'tesorero@residencia.com',
            'password' => Hash::make('12345678'),
            'ci' => 'V-1234546',
            'phone' => '1234546',
            'role_id' => Role::ROL_TESORERO,
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'first_name' => 'Test',
            'last_name' => 'Propietario',
            'email' => 'propietario@residencia.com',
            'password' => Hash::make('12345678'),
            'ci' => 'V-3434567',
            'phone' => '1234546',
            'role_id' => Role::ROL_PROPIETARIO,
        ]);

    }
}
