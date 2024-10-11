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
        Schema::create('siniestros', function (Blueprint $table) {
            $table->id();
            $table->string('automovil');
            $table->string('aseguradora');
            $table->date('fechaSiniestro');
            $table->string('estatus');
            $table->string('responsable');
            $table->decimal('CostoEstimado', 10, 2)->nullable();
            $table->decimal('CostoFinal', 10, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('observaciones')->nullable();
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
