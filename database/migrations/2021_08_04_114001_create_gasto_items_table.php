<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gasto_id')->constrained('gastos')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->decimal('precio_u');
            $table->decimal('iva');
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
        Schema::dropIfExists('gasto_items');
    }
}
