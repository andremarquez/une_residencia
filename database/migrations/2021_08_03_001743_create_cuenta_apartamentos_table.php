<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentaApartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_apartamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartamento_id')->constrained('apartamentos')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('propietario_id')->constrained('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('start_date');
            // si es null, es porque existe una cuenta activa
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta_apartamentos');
    }
}
