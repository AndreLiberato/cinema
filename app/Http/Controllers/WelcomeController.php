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
    public function index(): View
    {
        $sql_select_cinemas_enderecos = "SELECT c.*, e.id as endereco_id, e.estado, e.cidade, e.rua, e.numero
                                        FROM cinema c
                                        LEFT JOIN endereco e ON c.endereco_id = e.id";

        $cinemas = DB::select($sql_select_cinemas_enderecos);
        
        $sql_select_salas = "SELECT s.*, c.nome as cinema_nome
                            FROM sala s
                            LEFT JOIN cinema c ON s.cinema_id = c.id";

        $salas = DB::select($sql_select_salas);

        $sql_select_filmes = "SELECT f.* FROM filme f";

        $filmes = DB::select($sql_select_filmes);

        return view('welcome.index', ['cinemas' => $cinemas, 'salas' => $salas, 'filmes' => $filmes]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $cinema_id = $request->cinema;

        $sql_select_cinema_endereco = "SELECT c.*, e.id as endereco_id, e.estado, e.cidade, e.rua, e.numero
                                        FROM cinema c
                                        LEFT JOIN endereco e ON c.endereco_id = e.id
                                        WHERE c.id = ?";

        $cinema = DB::selectOne($sql_select_cinema_endereco, [$cinema_id]);

        $filme_id = $request->filme;

        $sql_select_filme = "SELECT f.*
                            FROM filme f
                            WHERE f.id = ?";

        $filme = DB::selectOne($sql_select_filme, [$filme_id]);

        $sala_id = $request->sala;

        $sql_select_sala = "SELECT s.*, c.nome as cinema_nome
                            FROM sala s
                            LEFT JOIN cinema c ON s.cinema_id = c.id
                            WHERE s.id = ?";

        $sala = DB::selectOne($sql_select_sala, [$sala_id]);

        return view('welcome.show', ['cinema' => $cinema, 'filme' => $filme, 'sala' => $sala]);
    }
}