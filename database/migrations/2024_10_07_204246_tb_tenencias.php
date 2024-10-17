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
        Schema::create('tenencias', function (Blueprint $table) {
            $table->id('id_tenencia'); 
            $table->date('fecha_pago'); 
            $table->string('origen'); 
            $table->decimal('monto', 10, 2); 
            $table->year('año_correspondiente'); 
            $table->string('estatus'); 
            $table->date('fecha_vencimiento'); 
            $table->string('comprobante');
            $table->text('observaciones')->nullable(); 
            $table->boolean('activo')->default(0);  // borrado logico del sistema
            $table->timestamps(); 
            
            $table->foreignId('id_automovil')->constrained('automoviles', 'id_automovil')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenencias');
    }
};
