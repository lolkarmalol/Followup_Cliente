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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer("codigo");
            $table->string("tipo");
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
            $table->foreignId('id_company')->constrained('companies')->onDelete('cascade'); // Asegúrate de que 'companies' es el nombre correcto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
