<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    
    <header class="header" style="background: #4f46e5;">
        <div class="container d-flex justify-content-between align-items-center" style="width: 100%;">
            <h1 class="logo m-0 text-white">to-do list</h1>

            <div class="dropdown">
                <button class="btn text-white fs-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-list"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/">Home</a></li>
                    <li><a class="dropdown-item" v-if="isAdmin" href="/tarefa/create">Cadastrar tarefa</a></li>
                    <li><a class="dropdown-item" v-if="isAdmin" href="/register">Cadastrar Usuário</a></li>
                    <li><a :href="`/user/${authUser.id}/perfil`" class="dropdown-item">Lixeira</a></li>
                    <li><a :href="`/user/${authUser.id}/perfil`" class="dropdown-item">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    {{-- <li><button class="dropdown-item text-danger" type="submit" @click="logout">Sair</button></li> --}}
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center w-100" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>


    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
