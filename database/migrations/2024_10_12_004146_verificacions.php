<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verificacions', function (Blueprint $table) {
            $table->bigIncrements('id_verificacion');
            $table->unsignedBigInteger('id_automovil');
            $table->string('holograma')->nullable();
            $table->enum('engomado', ['Amarillo', 'azul', 'rojo', 'ninguno'])->default('ninguno');
            $table->enum('estadoV', ['EdoMex', 'Morelos', 'CDMX']);
            $table->date('fechaV')->nullable();
            $table->date('fechaP')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('image')->nullable();
            //llave foranea
            $table->foreign('id_automovil')->references('id_automovil')->on('automoviles')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verificacions');
    }
};
