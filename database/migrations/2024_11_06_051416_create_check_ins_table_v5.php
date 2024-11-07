<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInsTableV5 extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->bigIncrements('id_check');
            $table->unsignedBigInteger('id_asignacion');
            $table->decimal('km_salida', 8, 2)->nullable();
            $table->decimal('combustible_salida', 8, 2)->nullable();
            $table->time('hora_salida')->nullable();
            $table->decimal('km_llegada', 8, 2)->nullable();
            $table->decimal('combustible_llegada', 8, 2)->nullable();
            $table->time('hora_llegada')->nullable();
            $table->date('fecha_llegada')->nullable(); // Columna para la fecha de llegada
            $table->foreign('id_asignacion')->references('id_asignacion')->on('asignacions')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
}
