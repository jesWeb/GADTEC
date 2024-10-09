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

        Schema::create('automovils',function(Blueprint $table){
            $table->id();
            $table->string('marca');
            $table->string('submarca');
            $table->string('modelo'); // O `text()` si es necesario
            $table->string('serie');
            $table->string('motor');
            $table->enum('combustible', ['gasolina', 'diesel', 'electrico'])->default('gasolina');
            $table->unsignedInteger('kilometraje')->nullable(); // Cambiado a entero
            $table->string('placas')->nullable();
            $table->string('NSI')->nullable();
            $table->enum('uso', ['transporte', 'comision', 'ninguno'])->default('ninguno'); // "comision" corregido
            $table->string('responsable')->nullable(); // O `text()` si es necesario
            // $table->text('observaciones')->nullable(); // Descomentar si es necesario
            // $table->string('image')->nullable(); // Descomentar si es necesario
            // $table->enum('posted', ['yes', 'not'])->default('not'); // Descomentar si es necesario
            $table->timestamps();
            // $table->unsignedBigInteger('car_id')->nullable(); // Descomentar y corregir el nombre
            // $table->foreign('car_id')->references('id')->on('cars'); // Ajustar según la tabla de referencia
            $table->softDeletes();
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
