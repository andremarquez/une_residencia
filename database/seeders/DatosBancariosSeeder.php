<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatosBancariosSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    // guardar la cuentas iniciales
    DB::table('datos_bancarios')->insert([
      'id' => 1,
      'rif' => 'J-0500001',
      'beneficiario' => 'Residencia Une',
      'nombre_banco' => 'Banesco',
      'numero_cuenta' => '01341233123445674578',
    ]);

    DB::table('datos_bancarios')->insert([
      'id' => 2,
      'rif' => 'J-0500001',
      'beneficiario' => 'Residencia Une',
      'nombre_banco' => 'Venezuela',
      'numero_cuenta' => '01021233123445674578',
    ]);
  }
}
