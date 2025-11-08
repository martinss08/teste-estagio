<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">


    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
        header.header {
            background: #4f46e5;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: 600;
        }
    </style>
</head>

<body class="font-sans antialiased">
    
    <header class="header py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="logo m-0 text-white">to-do list</h1>

        @auth
            <div class="dropdown">
                <button class="btn text-white fs-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-list"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/">Home</a></li>
                    <li><a class="dropdown-item" href="/tarefas/create">Cadastrar tarefa</a></li>
                    <li><a class="dropdown-item" href="/register">Cadastrar Usuário</a></li>
                    <li><a class="dropdown-item" href="#">Lixeira</a></li>
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-1"></i> Sair
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        @endauth
        </div>
    </header>
    

    <div class="container-fluid mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center w-100" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif
    </div>

    <main class="container my-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
