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
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->bigIncrements('id_tarjeta'); 
            $table->string('nombre', 100); 
            $table->string('num_tarjeta', 50)->unique(); 
            $table->string('vehiculo_origen', 100); 
            $table->date('fecha_expedicion'); 
            $table->date('fecha_vigencia'); 
            $table->enum('estatus', ['Vigente', 'Expirada', 'Suspendida'])->default('Vigente'); 
            $table->unsignedBigInteger('id_automovil'); 

            // Columnas para las fotografías
            $table->string('fotografia_frontal')->nullable(); 
            $table->boolean('activo')->default(0);  // borrado logico del sistema 

            $table->timestamps();

            // Definición de la clave foránea (relación con automóviles)
            $table->foreign('id_automovil')->references('id_automovil')->on('automoviles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjetas');
    }
};
