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
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->string('comentario')->nullable();
            $table->integer('nota')->nullable();
            $table->boolean('finalizado')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ejecucion_id');
            $table->timestamps();

            $table->foreign('ejecucion_id')->references('id')->on('ejecucions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};
