@extends('layouts.app')

@section('title', 'index') 

@section('content')
        <div>
            <h1>carregou</h1> 
            <a href="/tarefa/create">nova tarefa</a>
        </div>
         <div style="width:80%; margin:auto; ">
          <div style="width:100%">
                  <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ferramenta</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="margin:auto; ">Opçes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tarefas as $tarefa)
                            <tr>
                                <td>{{ $tarefa->id }}</td>
                                <td>{{ $tarefa->titulo }}</td>
                                <td>{{ $tarefa->descricao}}</td>
                                <td>{{ $tarefa->status}}</td>
                            
                                <td>
                                    <a href="/tarefa/edit/{{ $tarefa->id }}">
                                        Editar
                                    </a>

                                    <form action="/tarefa/delete/{{ $tarefa->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-danger">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
          </div>
        </div>

@endsection