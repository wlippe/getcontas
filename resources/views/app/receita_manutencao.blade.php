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
                                <input id="descricao" type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ $registro->descricao?? ''}}"required autocomplete="descricao" autofocus {{$show ? 'disabled':''}} >
                            </div>

                            <div class="col-md-4">
                                <label for="tipo" class="form-label"> Tipo </label>
                                <select id="tipo" name="tipo" class="form-control" @error('valor') is-invalid @enderror required {{$show ? 'disabled':''}} >
                                    <option value="" selected disabled>Selecione</option>
                                    <option value="1" {{$registro->tipo ?? '' == 1 ? "selected='selected'" : ""}} > Pontual </option>
                                    <option value="2" {{$registro->tipo ?? '' == 2 ? "selected='selected'" : ""}} > Semanal </option>
                                    <option value="3" {{$registro->tipo ?? '' == 3 ? "selected='selected'" : ""}} > Mensal  </option>
                                    <option value="4" {{$registro->tipo ?? '' == 4 ? "selected='selected'" : ""}} > Anual   </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="data" class="form-label"> Data </label>
                                <input id="data" type="date" class="form-control" name="data" required autocomplete="data" value="{{ $registro->data?? ''}}" {{$show ? 'disabled':''}} >
                            </div>

                            <div class="col-md-4">
                                <label for="valor" class="form-label"> Valor </label>
                                <input id="valor" type="text" class="form-control money @error('valor') is-invalid @enderror" 
                                name="valor" value="{{ $registro->valor?? ''}}" required autocomplete="valor" {{$show ? 'disabled':''}} placeholder="0,00">
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