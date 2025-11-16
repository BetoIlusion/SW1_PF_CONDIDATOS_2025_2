<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\OfertaTrabajoController;
use App\Http\Controllers\CurriculumController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Principal');
    // })->name('dashboard');
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');

    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');

    Route::prefix('ofertatrabajo')->group(function () {
        Route::get('/', [OfertaTrabajoController::class, 'index'])->name('ofertas.index');
        Route::get('/{id}', [OfertaTrabajoController::class, 'show'])->name('ofertas.show');
        Route::post('/', [OfertaTrabajoController::class, 'store'])->name('ofertas.store');
    });
    Route::prefix('cvs')->group(function () {
        Route::get('/', [CurriculumController::class, 'index'])->name('curriculums.index');
        Route::post('/', [CurriculumController::class, 'store'])->name('curriculums.store');
        Route::get('/{id}', [CurriculumController::class, 'show'])->name('curriculums.show');
    });
    Route::prefix('oferta-trabajo')->group(function () {

        
        Route::get('/create', [OfertaTrabajoController::class, 'create'])->name('ofertas.create');
        Route::get('/{id}/edit', [OfertaTrabajoController::class, 'edit'])->name('ofertas.edit');
        Route::put('/{id}', [OfertaTrabajoController::class, 'update'])->name('ofertas.update');
        Route::delete('/{id}', [OfertaTrabajoController::class, 'destroy'])->name('ofertas.destroy');
        Route::get('/{id}', [OfertaTrabajoController::class, 'show'])->name('ofertas.show');
    });
});
