<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProveedoresSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    DB::table('proveedores')->insert([
      'id' => 1,
      'rif' => 'J-232323',
      'name' => 'Proveedor 1',
      'address' => 'Zona A',
      'phone' => '1111111',
      'description' => 'proveedor descripcion'
    ]);

    DB::table('proveedores')->insert([
      'id' => 2,
      'rif' => 'J-565656',
      'name' => 'Proveedor 2',
      'address' => 'Zona B',
      'phone' => '2222222',
      'description' => 'proveedor descripcion'
    ]);
  }
}
