<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE TABLE filme (
            id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            titulo VARCHAR(64) NOT NULL UNIQUE,
            diretor VARCHAR(128) NOT NULL,
            genero VARCHAR(64) NOT NULL,
            classificacao_indicativa VARCHAR(32) NOT NULL,
            duracao TIME NOT NULL,
            sinopse MEDIUMTEXT NOT NULL,
            copyrights VARCHAR(32) NOT NULL
        )');
        // Schema::create('filme', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('titulo', 64);
        //     $table->string('diretor', 128);
        //     $table->string('genero', 64);
        //     $table->string('classificacao_indicativa', 32);
        //     $table->time('duracao');
        //     $table->mediumText('sinopse');
        //     $table->string('copyrights', 32);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filme');
    }
};
