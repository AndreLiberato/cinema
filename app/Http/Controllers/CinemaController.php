<?php

namespace App\Http\Controllers;

use App\Http\Requests\CinemaStoreRequest;
use App\Http\Requests\CinemaUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sql_select_cinemas_enderecos = "SELECT c.*, e.id as endereco_id, e.estado, e.cidade, e.rua, e.numero
                                        FROM cinema c
                                        LEFT JOIN endereco e ON c.endereco_id = e.id";

        $cinemas = DB::select($sql_select_cinemas_enderecos);

        return view('cinema.index', ['cinemas' => $cinemas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cinema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CinemaStoreRequest $request): RedirectResponse
    {
        $request->validated();

        $cinema_nome = $request->nome;

        $sql = "INSERT INTO cinema (nome) VALUES (?)";

        $operationStatus = DB::statement($sql, [$cinema_nome]);

        if ($operationStatus) {
            return Redirect::route('cinema.create')->with('status', 'sucesso');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): View
    {
        $cinema_id = $request->cinema;

        $sql_select_cinema_endereco = "SELECT c.*, e.id as endereco_id, e.estado, e.cidade, e.rua, e.numero
                                        FROM cinema c
                                        LEFT JOIN endereco e ON c.endereco_id = e.id
                                        WHERE c.id = ?";

        $cinema = DB::selectOne($sql_select_cinema_endereco, [$cinema_id]);

        return view('cinema.show', ['cinema' => $cinema]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        $cinema_id = $request->cinema;

        $sql_select_cinema = "SELECT c.* FROM cinema c WHERE c.id = ?";

        $cinema = DB::selectOne($sql_select_cinema, [$cinema_id]);

        return view('cinema.edit', ['cinema' => $cinema]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CinemaUpdateRequest $request, string $id): RedirectResponse
    {
        $request->validated();

        $cinema_nome = $request->nome;

        $sql_update_cinema = "UPDATE cinema
                                SET nome = ?
                                WHERE id = ?";
        
        $update_cinema_status = DB::statement($sql_update_cinema, [$cinema_nome, $id]);

        if ($update_cinema_status) {
            return Redirect::route('cinema.edit', ['cinema' => $id])->with('status', 'sucesso');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $cinema_id = $request->cinema;

        $sql_select_cinema = "SELECT c.* FROM cinema c WHERE c.id = ?";

        $cinema = DB::selectOne($sql_select_cinema, [$cinema_id]);

        $sql_delete_cinema = "DELETE FROM cinema WHERE id = ?";

        $n_deleted_cinemas = DB::delete($sql_delete_cinema, [$cinema_id]);

        if ($cinema->endereco_id) {
            $sql_delete_endereco_cinema = "DELETE FROM endereco WHERE id = ?";

            DB::delete($sql_delete_endereco_cinema, [$cinema->endereco_id]);
        }

        if ($n_deleted_cinemas == 1) {
            return Redirect::route('cinema.index')->with('status', 'sucesso');
        }
    }
}
