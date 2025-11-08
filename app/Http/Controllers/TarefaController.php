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

    public function index(Request $request) 
    {
        $user = auth()->user();

        $query = $this->model->where('user_id', $user->id);

        $statusBusca = $this->tarefaStatus->all();

        if($request->input('busca')) {
            $query->where(function ($q) use ($request) {
                $q->where('titulo', 'like', "%{$request->input('busca')}%");
            });
        }

        if($request->input('status')) {
             $query->where('status_id', $request->input('status'));
        }

        $tarefas = $query->paginate(10);  

        return view('welcome', [
            'tarefas' => $tarefas,
            'statusBusca' => $statusBusca
        ]);
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
        $tarefa = $this->model->where('user_id', auth()->user()->id)->find($id);

        if(!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada ou você não tem permissão para edita-la.');
        }

        $status = $this->tarefaStatus->all();

        return view('tarefa/tarefa-form', compact('tarefa', 'status'));
    }

    public function update($id, TarefaRequest $request)
    {
        $tarefa = $this->model->where('user_id', auth()->user()->id)->find($id);

        if(!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada ou você não tem permissão para edita-la.');
        }


        $dados = $request->validated();

        $tarefa->update($dados);
    
        return redirect()->route('tarefas.index')->with('success', 'Tarefa editada com sucesso!');
    }

    public function destroy($id) 
    {
        $tarefa = $this->model->where('user_id', auth()->user()->id)->find($id);

        if(!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada ou você não tem permissão para deletá-la.');
        }

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
        $tarefa = $this->model->onlyTrashed()->where('user_id', auth()->user()->id)->find($id);

        if(!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada ou você não tem permissão para restaura-la.');
        }


        $tarefa->restore();

        return redirect()->route('tarefas.lixeira')->with('success', 'Tarefa restaurada com sucesso!');
    }

    public function forceDelete($id)
    {
        $tarefa = $this->model->onlyTrashed()->where('user_id', auth()->user()->id)->find($id);

        if(!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada ou você não tem permissão para exclui-la.');
        }
        $tarefa->forceDelete();

        return redirect()->route('tarefas.lixeira')->with('success', 'Tarefa excluída permanentemente!');
    }
}
