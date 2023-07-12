<?php

namespace App\Http\Controllers;

use App\Enums\TipoSalaEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function count(): View
    {
        $sql_count_filmes = "SELECT DISTINCT f.* FROM filme f";
        $sql_count_cinemas = "SELECT DISTINCT c.* FROM cinema c";
        $sql_count_salas = "SELECT DISTINCT s.* FROM sala s";

        $filmes_count = count(DB::select($sql_count_filmes));
        $cinemas_count = count(DB::select($sql_count_cinemas));
        $salas_count = count(DB::select($sql_count_salas));

        return view('dashboard', ['filmes_count' => $filmes_count, 'cinemas_count' => $cinemas_count, 'salas_count' => $salas_count]);
    }
}