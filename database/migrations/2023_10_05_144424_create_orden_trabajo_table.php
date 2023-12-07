    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateOrdenTrabajoTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('orden_trabajo', function (Blueprint $table) {
                $table->id();
                $table->string('numero_oc')->comment('Número de Orden de Compra');
                $table->unsignedBigInteger('cliente_id')->comment('Referencia al Cliente');
                $table->unsignedBigInteger('producto_id')->comment('Referencia al Producto');
                
                $table->foreign('cliente_id')
                    ->references('id')->on('clientes')
                    ->onDelete('cascade');  
                
                $table->foreign('producto_id')
                    ->references('id')->on('productos')
                    ->onDelete('cascade');  
                
                $table->enum('extrusora', ['extrusora1', 'extrusora2', 'extrusora3'])->comment('Tipo de Extrusora');
                $table->enum('selladora', ['selladora1', 'selladora2', 'selladora3'])->comment('Tipo de Selladora');
                $table->enum('microperforadora', ['micro1', 'micro2', 'micro3'])->comment('Tipo de Microperforadora');
                    
                $table->date('fecha')->comment('Fecha de la Orden');
                $table->integer('cantidad')->comment('Cantidad de Productos en la Orden');
                $table->date('fecha_comprometida')->comment('Fecha Comprometida de Entrega');
                $table->string('status_oc')->comment('Estado de la Orden de Compra');
                $table->decimal('porcentaje_progreso', 5, 2)->default(0)->comment('Porcentaje de Progreso de la Orden');
                $table->text('observaciones')->nullable()->comment('Observaciones sobre la Orden');
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
            Schema::dropIfExists('orden_trabajo');
        }
    }
