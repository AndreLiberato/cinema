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
        DB::statement('CREATE TABLE idioma_legenda
            (
                filme_id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                idioma_id BIGINT UNSIGNED NOT NULL,
                CONSTRAINT idioma_legenda_filme_id_foreign
                FOREIGN KEY (filme_id)
                REFERENCES filme (id)
                ON DELETE CASCADE,
                CONSTRAINT idioma_legenda_idioma_id_foreign
                FOREIGN KEY (idioma_id)
                REFERENCES idioma (id)
                ON DELETE CASCADE
            )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idioma_legenda');
    }
};
