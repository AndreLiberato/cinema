<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\EnderecoStoreRequest;
use App\Http\Requests\EnderecoUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EnderecoCinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): RedirectResponse
    {
        $cinema_id = $request->cinema_id;

        $sql_select_endereco = "SELECT e.*
                                FROM cinema c
                                JOIN endereco e ON c.endereco_id = e.id
                                WHERE c.id = ?";
                                
        $endereco = DB::selectOne($sql_select_endereco, [$cinema_id]);

        if ($endereco) {
            return Redirect::route('endereco_cinema.edit', ['endereco' => $endereco->id]);
        }

        return Redirect::route('endereco_cinema.create', ['cinema_id' => $cinema_id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $cinema_id = $request->cinema_id;
        return view('cinema.endereco.create', ['cinema_id' => $cinema_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnderecoStoreRequest $request): RedirectResponse
    {
        $request->validated();

        $estado = $request->estado;
        $cidade = $request->cidade;
        $rua = $request->rua;
        $numero = $request->numero;
        $cinema_id = $request->cinema_id;

        // Cria o endereço
        $sql_insert_endereco = "INSERT INTO endereco (estado, cidade, rua, numero) VALUES (?, ?, ?, ?)";
        $insert_endereco_status = DB::statement($sql_insert_endereco, [$estado, $cidade, $rua, $numero]);

        // Resgata o id do endereço criado
        $sql_select_endereco_id = "SELECT id FROM endereco WHERE estado = ? AND cidade = ? AND rua = ? AND numero = ?";
        $endereco_id = DB::selectOne($sql_select_endereco_id, [$estado, $cidade, $rua, $numero])->id;

        // Vincula ao cinema apropiado
        $sql_update_cinema = "UPDATE cinema SET endereco_id = ? WHERE id = ?";
        $update_cinema_status = DB::statement($sql_update_cinema, [$endereco_id, $cinema_id]);

        if ($insert_endereco_status && $update_cinema_status) {
            return Redirect::route('endereco_cinema.create')->with('status', 'sucesso');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {   
        $endereco_id = $request->endereco;

        $sql_select_endereco = "SELECT * FROM endereco WHERE id = ?";
        $endereco = DB::selectOne($sql_select_endereco, [$endereco_id]);

        return view('cinema.endereco.edit', ['endereco' => $endereco]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnderecoUpdateRequest $request, String $id)
    {
        $request->validated();

        $estado = $request->estado;
        $cidade = $request->cidade;
        $rua = $request->rua;
        $numero = $request->numero;

        $sql_update_endereco = "UPDATE endereco
                                SET estado = ?, cidade = ?, rua = ?, numero = ?
                                WHERE id = ?";

        $update_endereco_status = DB::statement($sql_update_endereco, [$estado, $cidade, $rua, $numero, $id]);

        if ($update_endereco_status) {
            return Redirect::route('endereco_cinema.edit', ['endereco' => $id])->with('status', 'sucesso');
        }
    }
}
