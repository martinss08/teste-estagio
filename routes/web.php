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
});

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


require __DIR__.'/auth.php';
