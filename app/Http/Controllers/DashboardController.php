<?php

namespace App\Http\Controllers;

use App\Enums\TipoSalaEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WelcomeController extends Controller
{
    public function cinemaIndex(): View
    {
        $sql_select_cinemas_enderecos = "SELECT c.*, e.id as endereco_id, e.estado, e.cidade, e.rua, e.numero
                                        FROM cinema c
                                        LEFT JOIN endereco e ON c.endereco_id = e.id";

        $cinemas = DB::select($sql_select_cinemas_enderecos);

        return view('cinema.index', ['cinemas' => $cinemas]);
    }

    public function salaIndex(): View
    {   
        $sql_select_salas = "SELECT DISTINCT COUNT(s.*, c.nome as cinema_nome
                            FROM sala s
                            LEFT JOIN cinema c ON s.cinema_id = c.id";

        $salas = DB::select($sql_select_salas);

        return view('sala.index', ['salas' => $salas]);
    }

    public function filmeCount(): View
    {
        $sql_select_filmes = "SELECT DISTINCT COUNT(f.*) FROM filme f";

        $filmes = DB::select($sql_select_filmes);

        return view('filme.count', ['filmes' => $filmes]);
    }
}