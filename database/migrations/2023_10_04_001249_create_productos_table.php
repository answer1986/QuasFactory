<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('material_base');
            $table->string('pintura');
            $table->decimal('ancho', 8, 2);  
            $table->decimal('alto', 8, 2);  
            $table->text('observaciones')->nullable();
            $table->string('foto')->nullable(); 
            $table->unsignedInteger('cantidad'); 
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
        Schema::dropIfExists('productos');
    }
}
