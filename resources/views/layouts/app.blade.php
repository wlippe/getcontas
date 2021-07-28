<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GetContas') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Biblioteca de Javascript do Bootstrap * -->
    <script 
        src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
        integrity = "sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin = "anonymous">
    </script>

    <!-- Biblioteca de Javascript JQuery * -->
    <script 
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <!-- Biblioteca CSS do Bootstrap 5x -->
    <link rel = "stylesheet" 
          href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
          integrity = "sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
          crossorigin = "anonymous" >

    <!-- Biblioteca de icones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" >

    {{-- <link href="{{ asset('css/app.css') }}"    rel="stylesheet"> --}}
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet" >

    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>

</head>
<body style="background-color:rgb(246,246,246)">
    <div id="app">
        <nav class="navbar navbar-expand-lg shadow-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ Auth::check() ?  route('home') : url('/') }}">
                    {{ config('app.name', 'getContas') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Lado Esquerdo do Menu -->
                        @if(Auth::check())

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                <a class="nav-link" href="/app/resumo-mensal"> Resumo Mensal  </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="/app/contas-a-pagar"> Contas a Pagar </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                         Gerenciar
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right navbar-dark bg-dark" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item texto_branco_item" href="{{ route('receita') }}">
                                            Receitas
                                        </a>
                                        <a class="dropdown-item texto_branco_item" href="{{ route('despesa') }}">
                                            Despesas
                                        </a>
                                        <a class="dropdown-item texto_branco_item" href="{{ route('cartaocredito') }}">
                                            Cartões de Créditos
                                        </a>
                                        <a class="dropdown-item texto_branco_item" href="{{ route('conta') }}">
                                            Contas
                                        </a>
                                        <a class="dropdown-item texto_branco_item" href="{{ route('aplicacao') }}">
                                            Aplicações
                                        </a>
                                    </div>
                                </li>
                            </div>

                        @endif

                    <!-- Lado direito do Menu -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Links de Autenticação -->
                        @guest
                             @if (Route::has('contato'))
                                <li class="nav-item">
                                    <a class="nav-link" href="/contato"> 
                                        Contato 
                                    </a>
                                </li>
                            @endif  

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"> 
                                        Entrar 
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"> 
                                        Cadastrar-se
                                    </a>
                                </li>
                            @endif 
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right navbar-dark bg-dark" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item texto_branco_item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

@php /*
        <!-- mensagens de sucesso, alerta e erro -->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>

        <div style="z-index:1; position: absolute; float:right; margin-top: 1rem; margin-right: 1rem;">

        
            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div>
                        An example alert with an icon
                    </div>
            </div>

            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    An example success alert with an icon
                </div>
            </div>

            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        An example warning alert with an icon
                    </div>
            </div>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        An example danger alert with an icon
                    </div>
            </div>
        
        */ @endphp 
        
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<footer>
    <script type="text/javascript" src="{{ asset('js/comportamento.js') }}"></script>
</footer>
</html>