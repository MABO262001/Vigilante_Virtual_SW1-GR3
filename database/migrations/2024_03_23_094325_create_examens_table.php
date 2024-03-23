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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('tema');
            $table->string('descripcion')->nullable;
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->integer('ponderacion');
            $table->string('contrasena');
            $table->unsignedBigInteger('id_docente');
            $table->timestamps();

            $table->foreign('id_docente')->references('id')->on('users')->onDelete('cascade');
            //Esta asociado temporalmente con usuario, hasta que se desarrolle la parte de docente, no reniene(n)
            //Att: papitas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
