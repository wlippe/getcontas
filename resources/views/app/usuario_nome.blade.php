
@extends('layouts.manutencao_padrao')

@section('titulo') {{ $titulo }} @endsection

@section('formulario') 
<form method="POST" action="{{ route($rota) }}">
    @csrf

    <div class="mb-3"> 
        <label for="name" class="form-label"> Nome </label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $registro->name?? ''}}" autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="direita">
        <x-botao_salvar/>
    </div>
</form>

@endsection