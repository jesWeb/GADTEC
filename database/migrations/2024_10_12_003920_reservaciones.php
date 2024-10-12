<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('solicitante');
            $table->string('telefono');
            $table->enum('requierechofer', ['sí', 'no']); // Cambiado a enum
            $table->string('nombre_chofer')->nullable();
            $table->string('vehiculo');
            $table->string('lugar');
            $table->time('hora_salida'); // O dateTime si necesitas fecha y hora
            $table->string('no_licencia');
            $table->text('condiciones')->nullable(); // Opcional
            $table->text('observaciones')->nullable(); // Opcional
            $table->string('autorizante');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
