@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 fs-1">
      Lista de Tarefas
    </h1>

    <a href="/tarefas/create"class="btn btn-primary mr-5" style="margin-bottom: 1rem;">
      Nova Tarefa
    </a>


    <div style="width:90%; margin:auto; ">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tarefa</th>
                        <th scope="col">Data</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="margin:auto; ">Opçes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarefas as $tarefa)
                        <tr>
                            <td>{{ $tarefa->id }}</td>
                            <td>{{ $tarefa->titulo }}</td>
                            <td>{{ $tarefa->status->nome ?? '-' }}</td>
                            <td>{{ $tarefa->created_at->format('d/m/Y') }}</td>
                        
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <a href="{{ route('tarefas.edit', $tarefa->id) }}"  
                                        class="btn btn-link p-0 text-primary fs-5" >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger fs-5" >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
        </div>
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
    </div>
</div>

@endsection