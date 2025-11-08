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
        $user = auth()->user();
        $tarefas = $this->model
                        ->where('user_id', $user->id)
                        ->with('status')             
                        ->paginate(10);             

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

        $dados['user_id'] = auth()->id();

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

    public function lixeira()
    {
        $user = auth()->user();

        $tarefas = $this->model
                        ->onlyTrashed()
                        ->where('user_id', $user->id)
                        ->with('status')
                        ->paginate(10);

        return view('tarefa.lixeira-tarefa', ['tarefas' => $tarefas]);
    }

    public function restore($id)
    {
        $tarefa = $this->model->onlyTrashed()->findOrFail($id);
        $tarefa->restore();

        return redirect()->route('tarefas.lixeira')->with('success', 'Tarefa restaurada com sucesso!');
    }

    public function forceDelete($id)
    {
        $tarefa = $this->model->onlyTrashed()->findOrFail($id);
        $tarefa->forceDelete();

        return redirect()->route('tarefas.lixeira')->with('success', 'Tarefa excluída permanentemente!');
    }
}
