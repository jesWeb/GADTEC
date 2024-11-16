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
            $table->bigIncrements('id_siniestro');
            $table->unsignedBigInteger('id_automovil');
            $table->date('fecha_siniestro')->nullable();
            $table->string('descripcion')->nullable();
            $table->enum('estatus', ['Pendiente', 'En Proceso', 'Cerrado'])->default('Pendiente');
            $table->decimal('costo_danos_estimados', 10, 2)->unsigned()->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->text('observaciones')->nullable();
            //llave foranea
            $table->foreign('id_automovil')->references('id_automovil')->on('automoviles')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
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
