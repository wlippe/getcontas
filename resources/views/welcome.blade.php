@extends('layouts.app')

@section('content')
<div class="padrao_site">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
        <div class="card h-100">
            <img src="{{ asset('img/site_receita.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Receitas</h5>
            <p class="card-text">Cadastre suas receitas mensais para ter o controle de todo valor que entra em sua conta.</p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('receita')}}"> Acessar Receitas </a>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card h-100">
            <img src="{{ asset('img/site_despesa.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Despesas</h5>
            <p class="card-text">Administre corretamente as despesas para ter uma vida financeira saudável. </p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('despesa')}}">  Acessar Despesas </a>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card h-100">
            <img src="{{ asset('img/site_graficos.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Aplicações</h5>
            <p class="card-text">Monitore suas Aplicações e faça projeções para os rendimentos futuros. </p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('aplicacao')}}">  Acessar Aplicações </a>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
