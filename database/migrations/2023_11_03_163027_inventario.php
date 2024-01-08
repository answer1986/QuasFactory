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
        Schema::table('inventarios', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_terminado_id')->nullable()->after('ingreso_materia_prima_id');
            $table->id();
            $table->unsignedBigInteger('ingreso_materia_prima_id');
            $table->integer('cantidad_sacos');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('turno');
            $table->string('num_maquina');
            $table->string('operario');
            $table->date('nueva_fecha');
            $table->timestamps();

            $table->foreign('ingreso_materia_prima_id')->references('id')->on('ingreso_materia_prima');
        });
    }

    public function down()
    {
        Schema::table('inventarios', function (Blueprint $table) {
        $table->dropColumn('producto_terminado_id');
        $table->id();
        $table->unsignedBigInteger('ingreso_materia_prima_id');
        $table->integer('cantidad_sacos');
        $table->date('fecha_inicio');
        $table->date('fecha_fin');
        $table->string('turno')->nullable();
        $table->string('num_maquina')->nullable();
        $table->string('operario')->nullable();
        $table->date('nueva_fecha')->nullable();
        $table->timestamps();
        });
    }

}
