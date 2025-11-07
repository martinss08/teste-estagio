<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Http\Requests\TarefaRequest;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class TarefaController extends Controller
{
    protected $model;
    protected $tarefaStatus;

    public function __construct(Tarefa $model, Status $tarefaStatus)
    {
        $this->model = $model;
        $this->tarefaStatus = $tarefaStatus;
    }

   public function index() 
    {
        $tarefas = $this->model->with('status')->paginate(10);
        return view('welcome', ['tarefas' => $tarefas]);
    }

    public function create()
    {
        $status = $this->tarefaStatus->all();

        return view('tarefa/tarefa-form', compact('status'));
    }

    public function store(TarefaRequest $request)
    {
        $dados = $request->validated();

        $this->model->create($dados);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $tarefaEdit = $this->model->find($id);
        $status = $this->tarefaStatus->all();

        return view('tarefa/tarefa-form', compact('tarefaEdit', 'status'));
    }

    public function update($id, TarefaRequest $request)
    {
        $tarefa = $this->model->find($id);

        $dados = $request->validated();

        $tarefa->update($dados);
    
        return redirect()->route('tarefas.index')->with('success', 'Tarefa editada com sucesso!');
    }

    public function destroy($id) 
    {
        $tarefa = $this->model->find($id);

        $tarefa->delete();

        return redirect()->route('tarefas.index')->with('success', 'Tarefa deletada com sucesso!');
    }
}
