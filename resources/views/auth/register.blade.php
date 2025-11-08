@extends('layouts.app')

@section('content')
<div class="w-50 mx-auto mt-5 p-3 border rounded-3 shadow">
    <h1 class="fs-2 text-center p-2 my-3 mx-auto">
        {{ isset($user)
            ? ($user->id === auth()->id()
                ? 'Meu Perfil'
                : 'Editar Usuário')
            : 'Cadastrar Usuário' }}
    </h1>

    <div class="d-flex justify-content-center">
        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
            class="w-75 mx-auto p-2"
            method="POST" >
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="mx-auto mb-3">
                <label class="ps-5" for="name">Nome</label>
                <input type="text" name="name"
                    value="{{ old('name', $user->name ?? '') }}"
                    class="w-75 mx-auto form-control 
                    @error('name') is-invalid @enderror"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mx-auto mb-3">
                <label class="ps-5" for="email">Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $user->email ?? '') }}"
                    class="w-75 mx-auto form-control 
                    @error('email') is-invalid @enderror"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 mx-auto">
                <label class="ps-5" for="password" >
                    Senha
                    @if(isset($user))
                        <small class="text-muted">(deixe em branco para não alterar)</small>
                    @endif
                </label>
                <input type="password" name="password"
                    class="w-75 mx-auto form-control @error('password') is-invalid @enderror"
                    >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid mx-auto p-2">
                <button type="submit" class="btn btn-primary mt-4">
                    {{ isset($user) ? 'Atualizar' : 'Cadastrar' }}
                </button>
            </div>
        </form>
    </div>

    @guest
        <div class="my-3 text-center">
            <a href="{{ route('login') }}" class="logs">
                Fazer login
            </a>
        </div>
    @endguest
</div>

<style>

input[type="text"],
input[type="email"],
input[type="password"] {
    outline: none;
    box-shadow: none;
    padding-left: 10px;
    height: 35px;
    border: none;
    border-bottom: 1px solid #a19d9d79;
}

</style>
@endsection
