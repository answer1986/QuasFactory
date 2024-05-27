<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rproduccion extends Migration
{

    public function up()
    {
        Schema::create('rproduccion', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('kilostotales');
            $table->integer('kilosscrap');
            $table->integer('kilosprogramados');
            $table->integer('kiloproducto');
            $table->integer('totalkilosxmaquina');
            $table->integer('numerocambioxprog');
            $table->integer('kilosprodprog');
            $table->integer('kilosscrapproce');
            $table->integer('kiloproducxmaqperiod');
            $table->string('machine_type');
            $table->string('orden_produccion')->nullable();
            $table->integer('kilos_fabricados')->nullable();
            $table->integer('kilos_programados')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rproduccion');
    }
}


