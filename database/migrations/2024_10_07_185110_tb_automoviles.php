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
        Schema::create('automoviles', function (Blueprint $table) {
            $table->bigIncrements('id_automovil'); 
            $table->string('num_serie', 30)->nullable(); 
            $table->string('marca', 50); 
            $table->string('submarca', 50); 
            $table->string('modelo', 50); 
            $table->string('num_motor', 50); 
            $table->enum('tipo_combustible', ['Gasolina', 'Diésel', 'Eléctrico'])->nullable(); 
            $table->integer('kilometraje')->nullable(); 
            $table->string('placas', 20)->nullable(); 
            $table->string('num_nsi', 50)->nullable();
            $table->string('uso', 70)->nullable(); 
            $table->text('estatus')->nullable(); 
            $table->date('fecha_registro')->nullable();
            $table->string('responsable', 50)->nullable(); 
            $table->text('fotografias')->nullable(); 
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(0); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automoviles');
    }
};
