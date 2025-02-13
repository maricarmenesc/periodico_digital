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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id('id_foto');
            $table->unsignedBigInteger('id_noticia');
            $table->string('correo_fotografo');
            $table->string('foto_principal');
            $table->string('foto_secundaria')->nullable();
            $table->timestamps();

            $table->foreign('id_noticia')->references('id_noticia')->on('noticias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
