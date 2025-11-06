<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Http\Requests\TarefaRequest;
use Illuminate\Database\Eloquent\Model;

class TarefaController extends Controller
{
    protected $model;

    public function __construct(Tarefa $model)
    {
        $this->model = $model;
    }

   public function index() 
    {
        $tarefas = $this->model->all();
        return view('welcome', ['tarefas' => $tarefas]);
    }

    public function create()
    {
        return view('tarefa/tarefa-form');
    }

    public function store(TarefaRequest $request)
    {
        $dados = $request->validated();

        $this->model->create($dados);

        return redirect('/')->with(['success' => 'Tarefa cadastrado com sucesso!']);
    }

    public function edit($id)
    {
        $tarefaEdit = $this->model->find($id);

        return view('tarefa/tarefa-form', ['tarefaEdit' => $tarefaEdit]);

    }

    public function update($id, TarefaRequest $request)
    {
        $tarefa = $this->model->find($id);

        $dados = $request->validated();

        $tarefa->update($dados);
    
        return redirect('/')->with(['success' => 'Tarefa editada com sucesso!']);
    }

    public function destroy($id) 
    {
        $tarefa = $this->model->find($id);

        $tarefa->delete();

        return redirect('/')->with(['success' => 'Tarefa deletada com sucesso!']);
    }
}
