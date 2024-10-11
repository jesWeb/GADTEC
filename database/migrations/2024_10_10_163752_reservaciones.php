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
        //
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('automovil');
            $table->string('responsable');
            $table->date('fechaR');
            $table->time('salida'); // Puedes usar `dateTime` si necesitas fecha y hora
            $table->string('destino');
            $table->string('motivo'); // Asegúrate de que el nombre sea consistente
            $table->date('fechaI');
            $table->string('placas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
