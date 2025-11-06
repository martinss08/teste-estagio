<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
       <form action="{{ isset($tarefaEdit) ? route('tarefa.update', $tarefaEdit->id) : route('tarefa.store') }}" method="POST">
        @csrf

        @if(isset($tarefaEdit))
            @method('PUT')
        @endif

        <div>
            <label>titulo</label>
            <input type="text" name="titulo" @error('titulo') is-invalid @enderror 
                value="{{ old('titulo', $tarefaEdit->titulo ?? '' ) }}"
            >
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>descrição</label>
            <input type="text" name="descricao" @error('descricao') is-invalid @enderror 
                value="{{ old('descricao', $tarefaEdit->descricao ?? '' ) }}"
            >
             @error('descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>status</label>
            <select name="status">
                <option value="pendente">Pendente</option>
                <option value="concluida">Concluída</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
        </div>
</body>
</html>