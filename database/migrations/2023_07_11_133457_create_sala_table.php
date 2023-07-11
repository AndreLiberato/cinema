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
        DB::statement('CREATE TABLE sala (
            id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            cinema_id BIGINT UNSIGNED NOT NULL,
            numero INT UNSIGNED NOT NULL,
            tipo VARCHAR(32) NOT NULL,
            capacidade INT UNSIGNED NOT NULL,
            CONSTRAINT sala_cinema_id_foreign
            FOREIGN KEY (cinema_id)
            REFERENCES cinema (id)
            ON DELETE CASCADE
        )');

        // Schema::create('sala', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('numero', false, true);
        //     $table->string('tipo', 32);
        //     $table->integer('capacidade', false, true);
        //     $table->foreignId('cinema_id')
        //         ->constrained('cinema')
        //         ->cascadeOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sala');
    }
};
