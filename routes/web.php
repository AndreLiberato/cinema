<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\EnderecoCinemaController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('/dashboard', [DashboardController::class, 'count'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Cinema resource CRUD
    Route::resource('cinema', CinemaController::class);
    // Endereço resource CRUD
    Route::resource('endereco_cinema', EnderecoCinemaController::class)
        ->except(['destroy', 'show'])
        ->parameters(['endereco_cinema' => 'endereco']);
    // Sala resource CRUD
    Route::resource('sala', SalaController::class);
    // Filme resource CRUD
    Route::resource('filme', FilmeController::class);
    // Sessão resource CRUD
    Route::resource('sessao', SessaoController::class);
});

require __DIR__ . '/auth.php';
