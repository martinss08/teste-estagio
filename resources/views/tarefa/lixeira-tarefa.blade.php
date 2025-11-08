@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="w-100  mx-auto">        
        <h1 class="text-center mb-4 fs-1">
            Lixeira de Tarefas
        </h1>

        <a href="/" class="btn btn-primary ">
            Voltar para Home
        </a>
    </div>

    <table class="table table-bordered w-75 mx-auto mt-5">
        <thead>
            <tr>
                <th class="w-75 text-center">Tarefa</th>
                <th class="w-25 text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarefas as $tarefa )
                <tr>
                    <td class="text-center">{{ $tarefa->titulo }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('tarefas.restore', $tarefa->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                            </form>

                            <form action="{{ route('tarefas.forceDelete', $tarefa->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-evenly mx-auto mt-4" style="width: 250px;">
        <form method="GET" class="inline">
            <button 
                type="submit" 
                name="page" 
                value="{{ $tarefas->currentPage() - 1 }}" 
                class="btn btn-primary px-3 py-1 border rounded {{ $tarefas->onFirstPage() ? 'cursor-not-allowed opacity-50' : '' }}"
                {{ $tarefas->onFirstPage() ? 'disabled' : '' }}
            >
                Anterior
            </button>
        </form>

        <form method="GET" class="inline">
            <button 
                type="submit" 
                name="page" 
                value="{{ $tarefas->currentPage() + 1 }}" 
                class="btn btn-primary px-3 py-1 border rounded {{ $tarefas->hasMorePages() ? '' : 'cursor-not-allowed opacity-50' }}"
                {{ $tarefas->hasMorePages() ? '' : 'disabled' }}
            >
                Próximo
            </button>
        </form>
    </div>

</div>
@endsection
