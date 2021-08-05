<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained('facturas')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('dato_bancario_id')->constrained('datos_bancarios')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->dateTime('payment_date');
            $table->foreignId('cuenta_apartament_id')->constrained('cuenta_apartamentos')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('file_url');
            $table->foreignId('approved_by_treasurer')->nullable()->constrained('users')->onDelete('cascade')
                ->onUpdate('cascade');;
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
        Schema::dropIfExists('comprobantes');
    }
}
