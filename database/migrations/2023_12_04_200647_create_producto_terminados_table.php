<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTerminadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('producto_terminados', function (Blueprint $table) {
        $table->id();
        $table->string('numero_oc');
        $table->decimal('kilos', 8, 2);
        $table->string('tipo_producto');
        $table->unsignedBigInteger('producto_id');
        $table->integer('unidades');
        $table->date('fecha');
        $table->time('hora');
        $table->string('codigo_producto');
        $table->text('observaciones')->nullable();
        $table->integer('porcentaje_avance');
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
        Schema::dropIfExists('producto_terminados');
    }
}
