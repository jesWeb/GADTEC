<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //
        Schema::create('seguros', function (Blueprint $table) {
            $table->bigIncrements('id_seguro');
            $table->unsignedBigInteger('id_automovil');
            $table->string('aseguradora');
            $table->string('cobertura');
            $table->date('fecha_vigencia');
            $table->string('monto');
            $table->string('poilza')->nullable();
            $table->string('estatus');

            //llave foranea
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
        //
        Schema::dropIfExists('seguros');
    }
};
