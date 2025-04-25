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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->enum('empresa', ['GÄTSIMED', 'DYDETEC', 'TAE', 'DENSO'])
                  ->default('GÄTSIMED')
                  ->change(); // Cambia la columna sin perder datos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->enum('empresa', ['GÄTSIMED', 'DYDETEC', 'Empresa 3'])
                  ->default('GÄTSIMED')
                  ->change(); 
        });
    }
};
