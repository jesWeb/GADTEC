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
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id_rol');
            $table->string('clave', 30)->nullable();     
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();    
            $table->text('estatus')->nullable();        // registro => activo|inactivo
            $table->boolean('activo')->default(0);      // borrado logico del sistema
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
