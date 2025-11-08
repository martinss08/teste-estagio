@extends('layouts.app')

@section('content')
<div class="mx-auto my-5 box-custom">
    <h1 class="text-center mb-4 fs-1">
        Login
    </h1>

    <form class="w-100 d-flex flex-column mt-5" 
        method="POST" 
        action="{{ route('login') }}">
        @csrf

        <div class="d-flex flex-column mx-auto w-75 p-2 gap-2">
            <label for="email" class="fw-semibold">
                Email
            </label>
            <input type="text" name="email"
                class="form-control 
                @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                placeholder="Digite seu email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-column mx-auto w-75 p-2 gap-2">
            <label for="password" class="fw-semibold">
                Senha
            </label>
            <input type="password" name="password" class="form-control 
                @error('password') is-invalid @enderror"
                placeholder="Digite sua senha">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mx-auto my-2 py-2 px-3 w-75">
            <button type="submit" class="btn btn-primary w-100 mt-4">
                Login
            </button>
        </div>
    </form>

    <div class="my-3 text-center">
        <a href="{{ route('register') }}" class="text-decoration-none logs">
            Fazer Cadastro
        </a>
    </div>
</div>
@endsection