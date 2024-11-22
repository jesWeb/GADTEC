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
        Schema::create('multas', function (Blueprint $table) {
            $table->bigIncrements('id_multa');
            $table->enum('tipo_multa',  ['Federal', 'Estatal', 'Municipal', 'Guardia Nacional'])->default('Estatal');
            $table->decimal('monto', 8, 2);
            $table->date('fecha_multa');
            $table->string('lugar', 100);
            $table->enum('estatus', ['Pendiente', 'Pagada'])->default('Pendiente');
            $table->text('comprobante')->nullable();
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('id_automovil');
            $table->boolean('activo')->default(0);  // borrado logico del sistema
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
        Schema::dropIfExists('multas');
    }
};
