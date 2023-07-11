<?php

namespace App\Http\Controllers;

use App\Enums\TipoSalaEnum;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SalaStoreRequest;
use App\Http\Requests\SalaUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {   
        $sql_select_salas = "SELECT s.*, c.nome as cinema_nome
                            FROM sala s
                            LEFT JOIN cinema c ON s.cinema_id = c.id";

        $salas = DB::select($sql_select_salas);

        return view('sala.index', ['salas' => $salas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sql_select_cinemas = "SELECT c.id, c.nome FROM cinema c";

        $cinemas = DB::select($sql_select_cinemas);

        $tipos = TipoSalaEnum::get();

        return view('sala.create', ['cinemas' => $cinemas, 'tipos' => $tipos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaStoreRequest $request): RedirectResponse
    {
        $request->validated();

        $numero = $request->numero;
        $tipo = $request->tipo;
        $capacidade = $request->capacidade;
        $cinema_id = $request->cinema_id;

        $sql_create_sala = "INSERT INTO sala (cinema_id, numero, tipo, capacidade) VALUES (?, ?, ?, ?)";

        $create_status = DB::statement($sql_create_sala, [$cinema_id, $numero, $tipo, $capacidade]);

        if ($create_status) {
            return Redirect::route('sala.create')->with('status', 'sucesso');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): View
    {
        $sala_id = $request->sala;

        $sql_select_sala = "SELECT s.*, c.nome as cinema_nome
                            FROM sala s
                            LEFT JOIN cinema c ON s.cinema_id = c.id
                            WHERE s.id = ?";

        $sala = DB::selectOne($sql_select_sala, [$sala_id]);

        return view('sala.show', ['sala' => $sala]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        $sala_id = $request->sala;

        $sql_select_sala = "SELECT s.*, c.nome as cinema_nome
                            FROM sala s
                            LEFT JOIN cinema c ON s.cinema_id = c.id
                            WHERE s.id = ?";

        $sala = DB::selectOne($sql_select_sala, [$sala_id]);

        $sql_select_cinemas = "SELECT c.id, c.nome FROM cinema c";

        $cinemas_raw = DB::select($sql_select_cinemas);

        $cinemas = array_combine(array_column($cinemas_raw, 'id'), array_column($cinemas_raw, 'nome'));

        $tipos = TipoSalaEnum::get();

        return view('sala.edit', ['sala' => $sala, 'cinemas' => $cinemas, 'tipos' => $tipos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaUpdateRequest $request, string $id)
    {
        $request->validated();

        $numero = $request->numero;
        $tipo = $request->tipo;
        $capacidade = $request->capacidade;
        $cinema_id = $request->cinema_id;

        $sql_update_sala = "UPDATE sala
                                SET numero = ?, tipo = ?, capacidade = ?, cinema_id = ?
                                WHERE id = ?";

        $update_sala_status = DB::statement($sql_update_sala, [$numero, $tipo, $capacidade, $cinema_id, $id]);

        if ($update_sala_status) {
            return Redirect::route('sala.edit', ['sala' => $id])->with('status', 'sucesso');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $sala_id = $request->sala;

        $sql_delete_cinema = "DELETE FROM sala WHERE id = ?";

        $n_deleted_salas = DB::delete($sql_delete_cinema, [$sala_id]);

        if ($n_deleted_salas == 1) {
            return Redirect::route('sala.index')->with('status', 'sucesso');
        }
    }
}
