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
            <label for="aplicadoinicial" class="form-label"> Aplicado Inicial </label>
            <input id="aplicadoinicial" type="number" class="form-control @error('aplicadoinicial') is-invalid @enderror" name="aplicadoinicial" value="{{ $registro->aplicadoinicial?? ''}}" {{$show ? 'disabled':''}} required autocomplete="rendimento" 
            onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00" step=".01">
        </div>
    
        <div class="col-md-4">
            <label for="aplicadomensal" class="form-label"> Aplicado Mensal </label>
            <input id="aplicadomensal" type="number" class="form-control @error('aplicadomensal') is-invalid @enderror" name="aplicadomensal" value="{{ $registro->aplicadomensal?? ''}}" {{$show ? 'disabled':''}} required autocomplete="metamensal" 
            onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00" step=".01">
        </div>

        <div class="col-md-4">
            <label for="rendimentoanual" class="form-label"> Rendimento Anual </label>
            <input id="rendimentoanual" type="number" class="form-control money @error('rendimentoanual') is-invalid @enderror" name="rendimentoanual" value="{{ $registro->rendimentoanual?? ''}}" {{$show ? 'disabled':''}} required autocomplete="metafinal" 
            onchange="monetario()" onkeydown="monetario()" placeholder="0,00" step=".01">
        </div>
    </div>

    @if(!$show)
        <div class="direita mt1">
            <x-botao_salvar/>
        </div>
    @endif
</form>
@endsection