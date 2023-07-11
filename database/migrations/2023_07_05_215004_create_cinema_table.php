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
        DB::statement('CREATE TABLE cinema (
            id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(128) NOT NULL,
            endereco_id BIGINT UNSIGNED,
            CONSTRAINT cinema_endereco_id_foreign
            FOREIGN KEY (endereco_id)
            REFERENCES endereco (id)
            ON DELETE SET NULL
        )');
        // Schema::create('cinema', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nome', 128);
        //     $table->foreignId('endereco_id')
        //         ->nullable()
        //         ->constrained('endereco')
        //         ->nullOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema');
    }
};
