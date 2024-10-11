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

        //     if (!Schema::hasTable('automovils')) {

        // }

        Schema::create('automovils', function (Blueprint $table) {
            $table->id();
            $table->string('marca')->nullable();
            $table->string('submarca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serie')->nullable();
            $table->string('motor')->nullable();
            $table->enum('combustible', ['gasolina', 'diesel', 'electrico'])->default('gasolina');
            $table->unsignedInteger('kilometraje')->nullable();
            $table->string('placas')->nullable();
            $table->string('NSI')->nullable();
            $table->string('uso');
            $table->string('responsable')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Si deseas manejar eliminaciones suaves
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('automovils');
    }
};
