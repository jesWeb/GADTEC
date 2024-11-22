<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->bigIncrements('id_servicio');
            $table->string('tipo_servicio', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_servicio')->nullable();
            $table->date('prox_servicio')->nullable();
            $table->decimal('costo', 8, 2)->nullable();
            $table->string('lugar_servicio', 100);
            $table->unsignedBigInteger('id_automovil');
            $table->boolean('activo')->default(0);  // borrado logico del sistema
            $table->text('comprobante')->nullable();

            // Definición de la clave foránea (relación con automóviles)
            $table->foreign('id_automovil')->references('id_automovil')->on('automoviles')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
