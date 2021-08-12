
@extends('layouts.manutencao_padrao')

@section('titulo') {{ $titulo }} @endsection

@section('formulario') 

<div>
    <img src="{{ asset('img/user.jpg') }}" class="card-img-top" style="height: auto; width: auto; max-width: 100px; max-height: 100px;">

    <div>
        <label for="name" class="form-label" style="font-weight: bold;" > Nome: </label>
        <label for="name" class="form-label"> {{ $registro->name?? ''}} </label>
    </div>
    <div>
        <label for="name" class="form-label" style="font-weight: bold;"> E-mail: </label>
        <label for="name" class="form-label"> {{ $registro->email?? ''}} </label>
    </div>

</div>

<div style="padding-top: 1rem;">
    <a href="/usuario/nome" class="btn btn-primary btn-sm">
        <i class="bi bi-person"></i> Alterar Nome
    </a>

    <a href="/usuario/senha" class="btn btn-primary btn-sm">
        <i class="bi bi-key"></i> Alterar Senha
    </a>
</div>

<div style="padding-top: 1rem;">
    @if (session('success'))
        <div class="alert alert-success" role="alert" id="alert">
            {{ session('success') }} 
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger" role="alert" id="alert">
            {{ session('danger') }} 
        </div>
    @endif

</div>

@endsection