<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GetContas</title>

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

     <!--@toastr_css -->

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
                                <a class="nav-link" href="/resumo-mensal"> Resumo Mensal  </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="/contas-a-pagar"> Contas a Pagar </a>
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
                                        @php /*
                                        <a class="dropdown-item texto_branco_item" href="{{ route('cartaocredito') }}">
                                            Cartões de Créditos
                                        </a>
                                        */ @endphp
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
                                    <a class="dropdown-item texto_branco_item" href="{{ route('usuario') }}">
                                        Perfil
                                    </a>
                                    <a class="dropdown-item texto_branco_item" href="{{ route('contato') }}">
                                        Contato
                                    </a>
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

        </div>

        <main class="py-4">
<!--
            @jquery
            @toastr_js
            @toastr_render
-->

            @yield('content')
        </main>
    </div>
</body>
<footer>
    <script type="text/javascript" src="{{ asset('js/comportamento.js') }}"></script>
</footer>
</html>