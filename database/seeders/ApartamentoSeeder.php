<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Carga inicial de los apartamentos

        // codigos disponibles
        $codes = ['A', 'B'];

        $apartamentoId = 1;
        // insertar apartamentos para los 10 pisos
        for ($piso = 1; $piso <= 10; $piso++) {

            foreach ($codes as $codigoApartamento) {
                
                DB::table('apartamentos')->insert(
                    [
                        'id' => $apartamentoId,
                        'level' => $piso,
                        'code' => $codigoApartamento,
                        'aliquot' => 1 / 20
                    ]
                );

                $apartamentoId = $apartamentoId + 1;
            }
        }
    }
}
