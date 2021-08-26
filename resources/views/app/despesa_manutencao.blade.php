@extends('layouts.manutencao_padrao')

@section('titulo',   $titulo)

@section('formulario') 
<form method="POST" action=" @yield('rota') {{ route($rota) }}">
     @csrf
    <input name="id" type="hidden" value="{{ $registro->id ?? '' }}">

    <div class="row g-3">
        <div> 
            <label for="descricao" class="form-label"> Descrição </label>
            <input id="descricao" type="text" max="50" class="form-control @error('descricao') is-invalid @enderror" 
                   name="descricao" value="{{ $registro->descricao }}{{ old('descricao') }}" autocomplete="descricao" autofocus {{$show ? 'disabled':''}} >
        </div>

        <div class="col-md-6">
            <label for="datavencimento" class="form-label"> Data Vencimento</label>
            <input id="datavencimento" type="date" class="form-control @error('datavencimento') is-invalid @enderror" name="datavencimento" 
            autocomplete="datavencimento" value="{{ $registro->datavencimento?? ''}}{{ old('datavencimento') }}" {{$show ? 'disabled':''}} >
        </div>

        <div class="col-md-6">
            <label for="limite" class="form-label"> Valor </label>
            <input id="valor" type="number" class="form-control money @error('valor') is-invalid @enderror" 
            name="valor" value="{{ $registro->valor?? ''}}{{ old('valor') }}" autocomplete="valor" {{$show ? 'disabled':''}} 
            onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00">
        </div>

        <div class="col-md-6">
            <label for="tipo" class="form-label"> Tipo  {{ old('tipo')}} </label>
            <select id="tipo" name="tipo" class="form-control @error('tipo') is-invalid @enderror" {{$show ? 'disabled':''}} 
                onchange="onChangeTipo('div_parcelas')">
                <option selected disabled > Selecione </option>
                <option value="1" {{$registro->tipo == 1 ? "selected='selected'" : ""}} {{ intval(old('tipo')) == 1 ? "selected='selected'" : ""}}> Pontual </option>
                <option value="2" {{$registro->tipo == 2 ? "selected='selected'" : ""}} {{ intval(old('tipo')) == 2 ? "selected='selected'" : ""}}> Parcelada  </option>
            </select>
        </div>

        <div class="col-md-6" style="display:{{$registro->tipo == 3 ? "block" : "none"}}" id="div_parcelas">
            <label for="parcelastotal" class="form-label"> Número de Parcelas </label>
            <input id="parcelastotal" type="number" class="form-control @error('parcelastotal') is-invalid @enderror" 
            name="parcelastotal" value="{{ $registro->parcelastotal?? ''}}" autocomplete="parcelastotal" {{$show ? 'disabled':''}}>
        </div>

    </div>
    @if(!$show)
    <div class="direita mt1">
        <x-botao_salvar/>
    </div>
    @endif
</form>

<script type="text/javascript">

    function onChangeTipo(me) {
        var tipo = document.getElementById('tipo').value;

        if(tipo == 2)
            document.getElementById(me).style.display = 'block';
        else
            document.getElementById(me).style.display = 'none';
            document.getElementById('parcelastotal').value = '';
    }

    function onChangeAssociarCartao(me) {
        let associarCartao = document.getElementById('associar_a_cartao');

        if(associarCartao.checked)
            document.getElementById(me).style.display = 'block';
        else
            document.getElementById(me).style.display = 'none';
            document.getElementById('cartaocredito_id').value = '';
    }

</script>
@endsection