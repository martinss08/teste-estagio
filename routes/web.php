<?php

use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TarefaController::class, 'index'])->name('tarefa.index');
Route::get('/tarefa/create', [TarefaController::class, 'create']);
Route::post('/tarefa/store', [TarefaController::class, 'store'])->name('tarefa.store');
Route::get('/tarefa/edit/{id}', [TarefaController::class, 'edit'])->name('tarefa.edit');
Route::put('/tarefa/update/{id}', [TarefaController::class, 'update'])->name('tarefa.update');
Route::delete('/tarefa/delete/{id}', [TarefaController::class, 'destroy'])->name('tarefa.delete');