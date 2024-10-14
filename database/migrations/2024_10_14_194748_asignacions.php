<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('asignacions', function (Blueprint $table) {
            $table->id();
            $table->string('solicitante');
            $table->string('telefono');
            $table->enum('requierechofer', ['sí', 'no']);
            $table->string('nombre_chofer')->nullable();
            $table->string('vehiculo');
            $table->string('lugar');
            $table->time('hora_salida');
            $table->string('no_licencia');
            $table->text('condiciones')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('autorizante');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignacions');
    }
};
