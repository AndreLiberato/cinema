<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Requests\FilmeStoreRequest;
use App\Http\Requests\FilmeUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class FilmeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sql_select_filmes = "SELECT f.* FROM filme f";

        $filmes = DB::select($sql_select_filmes);

        return view('filme.index', ['filmes' => $filmes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('filme.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmeStoreRequest $request): RedirectResponse
    {
        $request->validated();

        $titulo = $request->titulo;
        $diretor = $request->diretor;
        $genero = $request->genero;
        $classificacao_indicativa = $request->classificacao_indicativa;
        $duracao = $request->duracao;
        $sinopse = $request-> sinopse;
        $copyrights = $request->copyrights;

        $sql_create_filme = "INSERT INTO filme (titulo, diretor, genero, classificacao_indicativa, duracao, sinopse, copyrights) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $create_status = DB::statement($sql_create_filme, [$titulo, $diretor, $genero, $classificacao_indicativa, $duracao, $sinopse, $copyrights]);

        if ($create_status) {
            return Redirect::route('filme.create')->with('status', 'sucesso');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $filme_id = $request->filme;

        $sql_select_filme = "SELECT f.*
                            FROM filme f
                            WHERE f.id = ?";

        $filme = DB::selectOne($sql_select_filme, [$filme_id]);

        return view('filme.show', ['filme' => $filme]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        $filme_id = $request->filme;

        $sql_select_filme = "SELECT f.* FROM filme f WHERE f.id = ?";

        $filme = DB::selectOne($sql_select_filme, [$filme_id]);

        return view('filme.edit', ['filme' => $filme]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmeUpdateRequest $request, string $id)
    {
        $request->validated();

        $titulo = $request->titulo;
        $diretor = $request->diretor;
        $genero = $request->genero;
        $classificacao_indicativa = $request->classificacao_indicativa;
        $duracao = $request->duracao;
        $sinopse = $request-> sinopse;
        $copyrights = $request->copyrights;

        $sql_update_filme = "UPDATE filme
                            SET titulo = ?, diretor = ?, genero = ?, classificacao_indicativa = ?, duracao = ?, sinopse = ?, copyrights = ?
                            WHERE id = ?";

        $update_filme_status = DB::statement($sql_update_filme, [$titulo, $diretor, $genero, $classificacao_indicativa, $duracao, $sinopse, $copyrights, $id]);

        if ($update_filme_status) {
            return Redirect::route('filme.edit', ['filme' => $id])->with('status', 'sucesso');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $filme_id = $request->filme;

        $sql_delete_filme = "DELETE FROM filme WHERE id = ?";

        $n_deleted_filmes = DB::delete($sql_delete_filme, [$filme_id]);

        if ($n_deleted_filmes == 1) {
            return Redirect::route('filme.index')->with('status', 'sucesso');
        }
    }
}
