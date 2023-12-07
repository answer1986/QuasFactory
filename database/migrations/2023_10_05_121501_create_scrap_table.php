<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrapTable extends Migration
{
    public function up()
    {
        Schema::create('scrap', function (Blueprint $table) {
            $table->id();
            $table->string('numero_oc');
            $table->decimal('kilos', 10, 2);
            $table->text('otros')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scrap');
    }
}
