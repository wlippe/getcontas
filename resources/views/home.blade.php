@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Painel') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            Bem-Vindo {{Auth::user()->name}}
                        </p>
                        {{-- <div class="col">
                            
                            <div class="card-body">
                            <a href="/receita" class="link" style="text-decoration: none"> <h5>Receitas</h5> </a>
                                <p class="card-text"> “Jamais gaste seu dinheiro antes de você possuí-lo.” </p>
                                <footer class="blockquote-footer"><cite title="Source Title"> Thomas Jefferson </cite></footer>
                                <br/>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
