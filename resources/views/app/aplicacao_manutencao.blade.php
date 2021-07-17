@extends('layouts.manutencao_padrao')

@section('titulo',   $titulo)

@section('formulario') 
<form method="POST" action="{{ route($rota) }}">
    @csrf
    <input name="id" type="hidden" value="{{ $registro->id ?? '' }}">

    <div class="row g-3">
        <div class="col-md-12"> 
            <label for="nome" class="form-label"> Nome </label>
            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $registro->nome?? ''}}"required autocomplete="nome" {{$show ? 'disabled':''}} autofocus  >
        </div>

        <div class="col-md-12"> 
            <label for="objetivo" class="form-label"> Objetivo </label>
            <textarea id="objetivo" rows="3" type="text" class="form-control @error('objetivo') is-invalid @enderror" name="objetivo" required autocomplete="objetivo"
                {{$show ? 'disabled':''}}  autofocus>{{$registro->objetivo?? ''}}</textarea>
        </div>

        <div class="col-md-4">
            <label for="rendimento" class="form-label"> Rendimento Anual </label>
            <input id="rendimento" type="number" class="form-control @error('rendimento') is-invalid @enderror" name="rendimento" value="{{ $registro->rendimento?? ''}}" {{$show ? 'disabled':''}} required autocomplete="rendimento" 
            onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00" step=".01">
        </div>
    
        <div class="col-md-4">
            <label for="metamensal" class="form-label"> Meta Mensal </label>
            <input id="metamensal" type="number" class="form-control @error('metamensal') is-invalid @enderror" name="metamensal" value="{{ $registro->metamensal?? ''}}" {{$show ? 'disabled':''}} required autocomplete="metamensal" 
            onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00" step=".01">
        </div>

        <div class="col-md-4">
            <label for="metafinal" class="form-label"> Meta Final </label>
            <input id="metafinal" type="number" class="form-control @error('metafinal') is-invalid @enderror" name="metafinal" value="{{ $registro->metafinal?? ''}}" {{$show ? 'disabled':''}} required autocomplete="metafinal" 
            onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00" step=".01">
        </div>
    </div>

    @if(!$show)
        <div class="direita mt1">
            <x-botao_salvar/>
        </div>
    @endif
</form>
@endsection