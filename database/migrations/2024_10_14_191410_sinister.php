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
        Schema::create('sinister', function (Blueprint $table) {
            $table->id();
            $table->string('vehiculo');
            $table->date('fecha_siniestro');
            $table->string('descripcion');
            $table->enum('estatus', ['activo', 'vencido']);
            $table->decimal('costo_danos_estimados', 10, 2);
            $table->decimal('costo_real_danos', 10, 2);
            $table->string('responsable');
            $table->text('observaciones')->nullable();
            $table->timestamps(); // Timestamps para created_at y updated_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('sinister');
    }
};
