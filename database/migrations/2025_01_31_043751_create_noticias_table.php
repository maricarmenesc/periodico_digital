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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id('id_noticia');
            $table->string('titulo');
            $table->unsignedBigInteger('id_autor');
            $table->dateTime('fecha_hora');
            $table->string('encabezado');
            $table->text('texto');
            $table->unsignedBigInteger('nombre_categoria');
            $table->boolean('estado_suscripcion')->default(false);
            $table->boolean('estado_autorizacion')->default(false);
            $table->timestamps();

            $table->foreign('id_autor')->references('id_autor')->on('autores')->onDelete('cascade');
            $table->foreign('nombre_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
