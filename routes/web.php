<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

use App\Http\Controllers\UserController;

Route::get('/', [TarefaController::class, 'index'])
    ->middleware('auth')
    ->name('tarefas.index');

Route::middleware('auth')->group(function () {
    Route::get('/tarefas/lixeira', [TarefaController::class, 'lixeira'])->name('tarefas.lixeira');
    Route::patch('/tarefas/{id}/restore', [TarefaController::class, 'restore'])->name('tarefas.restore');
    Route::delete('/tarefas/{id}/force-delete', [TarefaController::class, 'forceDelete'])->name('tarefas.forceDelete');

    Route::resource('tarefas', TarefaController::class);
    Route::resource('users', UserController::class);
});



require __DIR__.'/auth.php';
