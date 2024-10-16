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
            $table->string('solicitante')->nullable();
            $table->string('telefono')->nullable();
            $table->enum('requierechofer', ['sí', 'no']);
            $table->string('nombre_chofer')->nullable();
            $table->string('vehiculo')->nullable();
            $table->string('lugar')->nullable();
            $table->time('hora_salida')->nullable();
            $table->string('no_licencia')->nullable();
            $table->text('condiciones')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('autorizante')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignacions');
    }
};
