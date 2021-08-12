@extends('layouts.manutencao_padrao')

@section('titulo') {{ $titulo }} @endsection

@section('formulario') 
<form method="POST" action="{{ route($rota) }}">
@csrf
<input name="id" type="hidden" value="{{ $registro->id ?? '' }}">

<div class="row g-3">
    <div class="col-md-6"> 
        <label for="nome" class="form-label"> Nome </label>
        <input id="nome"  name="nome" type="text" max="50" class="form-control @error('nome') is-invalid @enderror" 
               value="{{ $registro->nome?? ''}}{{ old('nome') }}" autocomplete="nome" autofocus {{$show ? 'disabled':''}} >
    </div>

    <div class="col-md-6">
        <label for="tipo" class="form-label"> Tipo </label>
        <select id="tipo" name="tipo" class="form-control @error('tipo') is-invalid @enderror" {{$show ? 'disabled':''}} >
            <option value="" selected disabled>Selecione</option>
            <option value="1" {{$registro->tipo ?? '' == 1 ? "selected='selected'" : ""}}{{old('tipo') == 1 ? "selected='selected'" : ""}}> Carteira </option>
            <option value="2" {{$registro->tipo ?? '' == 2 ? "selected='selected'" : ""}}{{old('tipo') == 2 ? "selected='selected'" : ""}} > Bancária </option>
        </select>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label" > Descrição </label>
        <textarea id="descricao" name="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror" {{$show ? 'disabled':''}}
        >{{ $registro->descricao?? ''}}{{ old('descricao') }}
        </textarea>
    </div>

</div>
@if(!$show)
<div class="direita mt1">
    <x-botao_salvar/>
</div>
@endif
</form>
@endsection