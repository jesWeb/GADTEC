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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_usuario');
            $table->string('num_empleado', 30)->nullable();
            $table->string('nombre', 50);
            $table->string('app', 70);
            $table->string('apm', 70)->nullable();
            $table->set('empresa', ['GÄTSIMED', 'DYDETEC', 'Empresa 3'])->default('GÄTSIMED');    // no recomiendo tenerlo aqui por si hay mas empresas tabla aparte
            $table->date('fn');
            $table->set('sex', ['Femenino', 'Masculino'])->default('Femenino');
            $table->set('rol', ['Administrador', 'Moderador', 'Vigilante'])->default('Administrador');
            $table->string('gen', 50);
            $table->text('foto');
            $table->string('email')->unique(); // Cambia de text a string
            $table->text('usuario');
            $table->text('pass');
            $table->text('estatus')->nullable();    // registro => activo|inactivo
            $table->boolean('activo')->default(0);  // borrado logico del sistema
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
