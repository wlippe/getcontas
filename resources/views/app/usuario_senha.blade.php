
@extends('layouts.manutencao_padrao')

@section('titulo') {{ $titulo }} @endsection

@section('formulario') 
<form method="POST" action="{{ route($rota) }}">
    @csrf

    <div class="mb-3">
        <label for="senha_atual" class="form-label"> Senha Atual</label>
        <input id="senha_atual" type="password" class="form-control @error('senha_atual') is-invalid @enderror" name="senha_atual">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label"> Nova Senha </label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password-confirm" class="form-label"> Confirme a Senha </label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
    </div>

    <div class="direita">
        <x-botao_salvar/>
    </div>
</form>

@endsection