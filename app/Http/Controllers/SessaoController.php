<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SessaoStoreRequest;

class SessaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sql_select_sessoes =  "SELECT s.*, f.titulo as filme_titulo, sa.numero as sala_numero, c.nome as cinema_nome, idub.nome as idioma_dublagem, ileg.nome as idioma_legenda
                                FROM sessao s
                                JOIN filme f ON s.filme_id = f.id
                                JOIN sala sa ON s.sala_id = sa.id
                                JOIN idioma idub ON s.idioma_dublagem_id = idub.id
                                JOIN idioma ileg ON s.idioma_legenda_id = ileg.id
                                JOIN cinema c ON sa.cinema_id = c.id";

        $sessoes = DB::select($sql_select_sessoes);

        return view('sessao.index', ['sessoes' => $sessoes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sql_select_filmes = "SELECT f.id, f.titulo FROM filme f";

        $filmes = DB::select($sql_select_filmes);

        $sql_select_salas = "SELECT s.id, s.numero, c.nome as cinema_nome FROM sala s
                            JOIN cinema c ON s.cinema_id = c.id";

        $salas = DB::select($sql_select_salas);

        $sql_select_idiomas = "SELECT * FROM idioma";

        $idiomas = DB::select($sql_select_idiomas);

        return view('sessao.create', ['filmes' => $filmes, 'salas' => $salas, 'idiomas' => $idiomas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessaoStoreRequest $request)
    {
        $request->validated();

        $filme_id = $request->filme_id;
        $sala_id = $request->sala_id;
        $idioma_dublagem_id = $request->idioma_dublagem_id;
        $idioma_legenda_id = $request->idioma_legenda_id;
        $data_hora_inicio = $request->data_hora_inicio;
        $data_hora_fim = $request->data_hora_fim;

        $sql_insert_sessao = "INSERT INTO sessao (filme_id, sala_id, idioma_dublagem_id, idioma_legenda_id, data_hora_inicio, data_hora_fim) VALUES (?, ?, ?, ?, ?, ?)";
        
        $insert_sessao_status = DB::statement($sql_insert_sessao, [$filme_id, $sala_id, $idioma_dublagem_id, $idioma_legenda_id, $data_hora_inicio, $data_hora_fim]);

        if($insert_sessao_status) {
            return Redirect::route('sessao.create')->with('status', 'sucesso');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $sessao_id = $request->sessao;

        $sql_select_sessoes =  "SELECT s.*
                                FROM sessao s 
                                WHERE s.id = ?";

        $sessao = DB::selectOne($sql_select_sessoes, [$sessao_id]);

        $sql_select_filmes = "SELECT f.id, f.titulo FROM filme f";

        $filmes_raw = DB::select($sql_select_filmes);

        $filmes = array_combine(array_column($filmes_raw, 'id'), array_column($filmes_raw, 'titulo'));

        $sql_select_salas = "SELECT s.id, s.numero, c.nome as cinema_nome FROM sala s
                            JOIN cinema c ON s.cinema_id = c.id";

        $salas_raw = DB::select($sql_select_salas);

        $salas = array_combine(array_column($salas_raw, 'id'), array_column($salas_raw, 'numero'));

        $sql_select_idiomas = "SELECT * FROM idioma";

        $idiomas_raw = DB::select($sql_select_idiomas);

        $idiomas = array_combine(array_column($idiomas_raw, 'id'), array_column($idiomas_raw, 'nome'));

        return view('sessao.edit', ['sessao' => $sessao, 'filmes' => $filmes, 'salas' => $salas, 'idiomas' => $idiomas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
