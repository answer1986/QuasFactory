<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinaReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquina_reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('maquina_tipo'); 
            $table->string('maquina_nombre'); 
            $table->date('fecha_reserva');
            $table->unsignedBigInteger('orden_trabajo_id'); 
            $table->timestamps(); 

            
            $table->foreign('orden_trabajo_id')->references('id')->on('orden_trabajo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maquina_reservas');
    }
}
