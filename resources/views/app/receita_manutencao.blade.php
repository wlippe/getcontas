@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $titulo }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route($rota) }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $registro->id ?? '' }}">

                        <div class="row g-3">
                            <div class="col-md-12"> 
                                <label for="descricao" class="form-label"> Descrição </label>
                                <input id="descricao" type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ $registro->descricao?? ''}} {{ old('descricao') }}" autocomplete="descricao" autofocus {{$show ? 'disabled':''}} >
                            </div>

                            <div class="col-md-6">
                                <label for="data" class="form-label"> Data </label>
                                <input id="data" type="date" class="form-control @error('data') is-invalid @enderror" name="data" autocomplete="data" value="{{ $registro->data?? ''}}{{ old('data') ?? "" }}" {{$show ? 'disabled':''}} >
                            </div>

                            <div class="col-md-6">
                                <label for="valor" class="form-label"> Valor </label>
                                <input id="valor" type="number" class="form-control money @error('valor') is-invalid @enderror" 
                                name="valor" value="{{ $registro->valor?? ''}}{{ old('valor') ?? ""}}"  autocomplete="valor" 
                                onchange="this.value = parseFloat(this.value).toFixed(2)" {{$show ? 'disabled':''}} placeholder="0,00">
                            </div>

                            <div class="col-md-12"> 
                                <label for="conta_id" class="form-label"> Conta </label>
                                <select id="conta_id" name="conta_id" class="form-control @error('conta_id') is-invalid @enderror" {{$show ? 'disabled':''}} >
                                    @foreach($contas as $conta)
                                        <option value="{{ $conta->id }}" {{ $registro->conta_id == $conta->id ? "selected='selected'" : "" }} {{old('conta') == $conta->id ? "selected='selected'" : ""}} > {{ $conta->tipo .' - '. $conta->nome }} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        @if(!$show)
                        <div class="direita mt1">
                            <x-botao_salvar/>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection