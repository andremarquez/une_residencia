<?php

namespace Database\Seeders;

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

        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'admin@residencia.com',
            'password' => Hash::make('12345678'),
            'ci' => 'V-1234546',
            'phone' => '1234546',
            'role_id' => 1,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'first_name' => 'Test',
            'last_name' => 'Tesorero',
            'email' => 'tesorero@residencia.com',
            'password' => Hash::make('12345678'),
            'ci' => 'V-1234546',
            'phone' => '1234546',
            'role_id' => 2,
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'first_name' => 'Test',
            'last_name' => 'Propietario',
            'email' => 'propietario@residencia.com',
            'password' => Hash::make('12345678'),
            'ci' => 'V-1234546',
            'phone' => '1234546',
            'role_id' => 3,
        ]);
/*
        DB::table('user_role')->insert([
            
            'user_id' => 1
          ]);

          DB::table('user_role')->insert([
            'role_id' => 2,
            'user_id' => 2
          ]);
          DB::table('user_role')->insert([
            'role_id' => 3,
            'user_id' => 3
          ]);*/
    }
}
