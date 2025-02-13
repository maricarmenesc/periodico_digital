<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fotografos', function (Blueprint $table) {
            $table->id();
            $table->string('correo_fotografo')->unique();
            $table->unsignedBigInteger('id_usuario');
            $table->string('nombre_fotografo');
            $table->string('apellido_fotografo');
            $table->string('telefono')->nullable();
            $table->text('biografia')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotografos');
    }
};
