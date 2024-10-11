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
        Schema::create('verificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('vehiculo');
            $table->string('holograma');
            $table->string('engomado');
            $table->date('fechaV');
            $table->date('fechaP');
            $table->text('observaciones')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
