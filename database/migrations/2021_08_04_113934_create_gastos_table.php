<?php

use App\Models\Gasto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->decimal('subtotal');
            $table->decimal('monto_iva');
            $table->decimal('total');
            $table->integer('status')->default(Gasto::STATUS_INICIAL);
            // cuando el proveedor aprueba entonces se cambiaria el status a
            $table->foreignId('approved_by_treasurer')->nullable()->constrained('users')->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('gastos');
    }
}
