@extends('layouts.app')

@section('content')
<div class="container my-5">
   <div class="container">
        <h1 class="text-center mb-4 fs-1">
        Lista de Tarefas
        </h1>

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
    
                    <a href="/tarefas/create"class="btn btn-primary ">
                    Nova Tarefa
                    </a>
        
                    <div class="d-flex " >
                        <form class="d-flex" method="GET">
                            <input class="w-175 form-control form-control-sm me-2" type="text" name="busca"
                            placeholder="Buscar Tarefa"
                            value="{{ request()->get('busca', '') }}"
                            >

                            <select class="form-select form-select-sm me-2" name="status" id="">
                                <option value="">Todos</option>
                                @foreach ($statusBusca as $status )
                                    <option value="{{ $status->id }}" 
                                        {{ request()->get('status') == $status->id ? 'selected' : '' }}> {{ $status->nome }} 
                                    </option>
                                @endforeach
                            </select>

                            <button class="border-0 bg-transparent" type="submit" >
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data</th>
                                <th scope="col">Opçes</th>
                            </tr>
                        </thead>
                        <tbody>
                             @if($tarefas->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4 fs-5">
                                        Você ainda não tem tarefa cadastrada.
                                    </td>
                                </tr>
                            @endif
                            @foreach($tarefas as $tarefa)
                                <tr>
                                    <td>{{ $tarefa->id }}</td>
                                    <td>{{ $tarefa->titulo }}</td>
                                    <td>
                                        <i class="bi
                                            {{ $tarefa->status?->nome === 'Concluída' ? 'bi-check-circle text-success' : ($tarefa->status?->nome === 'Pendente' ? 'bi-x-circle text-danger' : 'bi-check-circle text-secondary') }}">
                                        </i>
                                        {{ $tarefa->status->nome ?? '-' }}
                                    </td>
        
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
            </div>
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