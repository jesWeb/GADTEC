<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

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
            $table->string('NSI');
            $table->string('uso');
            $table->string('responsable');
            $table->text('observaciones')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('automovils');
    }
};
