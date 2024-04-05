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
        Schema::create('grupo_materia_comprobantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_materia_id');
            $table->unsignedBigInteger('comprobante_id');
            $table->timestamps();

            $table->foreign('grupo_materia_id')->references('id')->on('grupo_materias')->onDelete('cascade');
            $table->foreign('comprobante_id')->references('id')->on('comprobantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_materia_comprobantes');
    }
};
