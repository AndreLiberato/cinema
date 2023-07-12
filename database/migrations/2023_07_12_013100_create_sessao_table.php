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
        DB::statement('CREATE TABLE sessao 
            (
                id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                filme_id BIGINT UNSIGNED NOT NULL,
                sala_id BIGINT UNSIGNED NOT NULL,
                idioma_dublagem_id BIGINT UNSIGNED NULL,
                idioma_legenda_id BIGINT UNSIGNED NULL,
                data_hora_inicio DATETIME NOT NULL,
                data_hora_fim DATETIME NOT NULL,
                CONSTRAINT sessao_filme_id_foreign
                FOREIGN KEY (filme_id)
                REFERENCES filme (id)
                ON DELETE CASCADE,
                CONSTRAINT sessao_sala_id_foreign
                FOREIGN KEY (sala_id)
                REFERENCES sala (id)
                ON DELETE CASCADE,
                CONSTRAINT sessao_idioma_dublagem_id_foreign
                FOREIGN KEY (idioma_dublagem_id)
                REFERENCES idioma (id)
                ON DELETE SET NULL,
                CONSTRAINT sessao_idioma_legenda_id_foreign
                FOREIGN KEY (idioma_legenda_id)
                REFERENCES idioma (id)
                ON DELETE SET NULL
            )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessao');
    }
};
