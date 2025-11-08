@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto mt-5">
        <div class="w-100  mx-auto">
            <h1 class="text-center mt-4 mb-4 fs-1">
                {{ isset($tarefaEdit) ? 'Editar Tarefa' : 'Criar Tarefa' }}
            </h1>
            <a href="/" class="btn btn-primary ">
                Voltar para Home
            </a>
        </div>
        
        <div class="mx-auto my-4 p-4 border shadow rounded-3" style="width: 450px;">
            <form action="{{ isset($tarefaEdit) ? route('tarefas.update', $tarefaEdit->id) : route('tarefas.store') }}" method="POST">
                @csrf
                @if (isset($tarefaEdit))
                    @method('PUT')
                @endif

                <div class="p-2">
                    <label for="titulo">Título</label>
                    <input 
                        type="text" 
                        name="titulo" 
                        class="form-control @error('titulo') is-invalid @enderror" 
                        value="{{ old('titulo', $tarefaEdit->titulo ?? '') }}"
                    >
                    @error('titulo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="p-2">
                    <label for="descricao">Descrição</label>
                    <textarea 
                        name="descricao" 
                        class="form-control @error('descricao') is-invalid @enderror"
                    >{{ old('descricao', $tarefaEdit->descricao ?? '') }}</textarea>

                    @error('descricao')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="p-2">
                    <label for="status">Status</label>
                    <select 
                        name="status_id" 
                        class="form-control @error('status_id') is-invalid @enderror"
                    >
                        <option value="">Selecione</option>
                        @foreach($status as $s)
                            <option 
                                value="{{ $s->id }}" 
                                {{ old('status_id', $tarefaEdit->status_id ?? '') == $s->id ? 'selected' : '' }}
                            >
                                {{ $s->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5 mb-0 mx-auto">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($tarefaEdit) ? 'Editar Tarefa' : 'Criar Tarefa' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection