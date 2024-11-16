<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{



    public function up(): void
    {
        Schema::create('automoviles', function (Blueprint $table) {
            $table->bigIncrements('id_automovil');
            // $table->unsignedBigInteger('id_asignacion');
            $table->string('marca', 20)->nullable();
            $table->string('submarca', 25)->nullable();
            $table->integer('modelo')->nullable();
            $table->string('num_serie', 20)->nullable();
            $table->string('num_motor', 20)->nullable();
            $table->integer('capacidad_combustible')->nullable();
            $table->enum('tipo_combustible', ['Gasolina', 'Diésel', 'Eléctrico'])->default('Gasolina');
            $table->enum('tipo_automovil', ['Automovil', 'Camioneta', 'Motocicleta'])->default('Automovil');
            $table->decimal('kilometraje', 8, 2)->unsigned()->nullable();
            $table->string('placas', 10)->nullable();
            $table->string('num_nsi', 20)->nullable();
            $table->enum('uso', ['Personal', 'Empresarial'])->default('Empresarial');
            $table->enum('estatus', ['Nuevo', 'Usado'])->default('Nuevo');
            $table->enum('estatusIn', ['disponible','baja','ocupado','servicio'])->default('disponible');
            $table->string('color', 20)->nullable();
            $table->integer('num_puertas')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('responsable', 50)->nullable();
            $table->string('fotografias')->nullable();
            $table->text('observaciones')->nullable();
            //relaciones
            // $table->foreign('id_asignacion')->references('id_asignacion')->on('asignacions')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automoviles');

    }
};
