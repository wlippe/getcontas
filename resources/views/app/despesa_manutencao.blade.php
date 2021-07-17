@extends('layouts.manutencao_padrao')

@section('titulo',   $titulo)

@section('formulario') 
<form method="POST" action=" @yield('rota') {{ route($rota) }}">
     @csrf
    <input name="id" type="hidden" value="{{ $registro->id ?? '' }}">

    <div class="row g-3">
        <div class="col-md-6"> 
            <label for="descricao" class="form-label"> Descrição </label>
            <input id="descricao" type="text" max="50" class="form-control @error('descricao') is-invalid @enderror" 
                   name="descricao" value="{{ $registro->descricao }}"required autocomplete="descricao" autofocus {{$show ? 'disabled':''}} >
        </div>

        <div class="col-md-6"> 
            <label for="titular" class="form-label"> Nome do Titular </label>
            <input id="titular" type="text" maxlength="50" size="50" class="form-control @error('titular') is-invalid @enderror" 
                   name="titular" value="{{ $registro->titular }}" required autocomplete="titular" autofocus {{$show ? 'disabled':''}} >
        </div>

        <div class="col-md-4">
            <label for="bandeira" class="form-label"> Bandeira </label>
            <select id="bandeira" name="bandeira" class="form-control" required {{$show ? 'disabled':''}} >
                <option value="" selected disabled >Selecione </option>
                <option value="1" {{ $registro->bandeira == 1 ? 'selected' : '' }} > Mastercard        </option>
                <option value="2" {{ $registro->bandeira == 2 ? 'selected' : '' }} > Visa              </option>
                <option value="3" {{ $registro->bandeira == 3 ? 'selected' : '' }} > American Express  </option>
                <option value="4" {{ $registro->bandeira == 4 ? 'selected' : '' }} > Hipercard         </option>
                <option value="5" {{ $registro->bandeira == 5 ? 'selected' : '' }} > Elo               </option>
                <option value="6" {{ $registro->bandeira == 6 ? 'selected' : '' }} > Outro             </option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="datavencimento" class="form-label"> Data Vencimento</label>
            <input id="datavencimento" type="date" class="form-control" name="datavencimento" required autocomplete="datavencimento" value="{{ $registro->datavencimento?? ''}}" {{$show ? 'disabled':''}} >
        </div>

        <div class="col-md-2">
            <label for="digitos" class="form-label"> Dígitos</label>
            <input id="digitos" type="text" min="4" maxlength="4" size="4" class="form-control" name="digitos" required autocomplete="digitos"
             value="{{ $registro->digitos?? ''}}" {{$show ? 'disabled':''}} >
        </div>

        <div class="col-md-2">
            <label for="limite" class="form-label"> Limite </label>
            <input id="limite" type="text" class="form-control money @error('limite') is-invalid @enderror" 
            name="limite" value="{{ $registro->limite?? ''}}" required autocomplete="limite" {{$show ? 'disabled':''}} placeholder="0,00">
        </div>

    </div>
    @if(!$show)
    <div class="direita mt1">
        <x-botao_salvar/>
    </div>
    @endif
</form>

<script type="text/javascript">
    $('#digitos').mask('0000')
</script>
@endsection