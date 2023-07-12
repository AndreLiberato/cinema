<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdiomasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO idioma (nome) VALUES
            ("Inglês"),
            ("Espanhol"),
            ("Português"),
            ("Francês"),
            ("Alemão"),
            ("Italiano"),
            ("Russo"),
            ("Mandarim"),
            ("Japonês"),
            ("Hindi")
        ');
    }
}
