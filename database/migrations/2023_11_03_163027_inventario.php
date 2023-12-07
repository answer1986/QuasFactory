<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingreso_materia_prima_id');
            $table->integer('cantidad_sacos');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();

            $table->foreign('ingreso_materia_prima_id')->references('id')->on('ingreso_materia_prima');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios');
    }

  
    
}
