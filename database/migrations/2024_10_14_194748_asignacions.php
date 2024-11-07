<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asignacions', function (Blueprint $table) {
            $table->bigIncrements('id_asignacion');
            $table->unsignedBigInteger('id_automovil');
            $table->unsignedBigInteger('id_usuario');
            $table->string('telefono')->nullable();
            $table->boolean('requierechofer')->default(false)->nullable();
            $table->string('nombre_chofer')->nullable();
            $table->string('lugar')->nullable();
            $table->date('fecha_asignacion')->nullable(); // Este campo será automático
            $table->time('hora_salida')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->date('fecha_estimada_dev')->nullable(); 
            $table->string('no_licencia')->nullable();
            $table->enum('estatus', ['Reservado', 'Disponible', 'Ocupado'])->default('Disponible');
            $table->text('condiciones')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('autorizante')->nullable();
            $table->string('motivo')->nullable();
            $table->foreign('id_automovil')->references('id_automovil')->on('automoviles')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignacions');
    }
};
