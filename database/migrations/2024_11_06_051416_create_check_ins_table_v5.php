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
            $table->float('km_salida', 8, 2)->nullable();
            $table->enum('combustible_salida', ['1/4', '1/2', '3/4', 'vacío', 'reserva', 'lleno'])->nullable();
            $table->time('hora_salida')->nullable();
            $table->float('km_llegada', 8, 2)->nullable();
            $table->enum('combustible_llegada', ['1/4', '1/2', '3/4', 'reserva', 'lleno'])->nullable();
            $table->time('hora_llegada')->nullable();
            $table->date('fecha_llegada')->nullable();
            $table->string('imagenes_ida_regreso')->nullable(); // img de ida 
            $table->string('imagenes_ida_regreso_c')->nullable(); // img de regreso
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
