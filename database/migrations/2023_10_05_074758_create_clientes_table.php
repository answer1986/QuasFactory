<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('foto')->nullable();
        $table->string('nombre')->unique();
        $table->string('rut')->unique();
        $table->string('razon_social')->unique();
        $table->string('giro');
        $table->string('telefono');
        $table->string('correo_electronico')->unique();
        $table->string('direccion');
        $table->string('pais');
        $table->boolean('credito');
        $table->text('otros')->nullable();
        $table->date('fecha_creacion')->unique();
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
    Schema::disableForeignKeyConstraints(); 
  
    Schema::dropIfExists('cliente');
    Schema::enableForeignKeyConstraints();
}

    }

