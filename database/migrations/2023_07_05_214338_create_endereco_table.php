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
        DB::statement('CREATE TABLE endereco (
            id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            estado VARCHAR(32) NOT NULL,
            cidade VARCHAR(64) NOT NULL,
            rua VARCHAR(128) NOT NULL,
            numero INT UNSIGNED NOT NULL,
            UNIQUE (estado, cidade, rua, numero)
        )');

        // Schema::create('endereco', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('estado', 32);
        //     $table->string('cidade', 64);
        //     $table->string('rua', 128);
        //     $table->integer('numero', false, true);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco');
    }
};
