<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoMateriaPrimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_materia_prima', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_barra');
            $table->string('tipo_materia');
            $table->decimal('cantidad', 10, 2);
            $table->string('proveedor');
            $table->date('fecha_ingreso');
            $table->text('descripcion')->nullable();
            $table->string('barcode_path')->nullable();  // Agrega esta línea
            $table->timestamps();
            $table->string('barcode_value')->unique()->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('ingreso_materia_prima');
    }
}
