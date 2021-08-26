@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"> Contato</div>
                <div class="card-body">
                        @if (session('sucess'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('sucess') }} 
                            </div>
                        @endif
                    <form method="POST" action="{{ route('contato') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label"> Nome </label>
                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" 
                                value="{{ old('nome') }}{{ Auth::user() ? Auth::user()->name : "" }}"
                                {{ Auth::user() ? "disabled" : "" }} required autocomplete="nome" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"> E-Mail </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                            value="{{ old('email') }}{{ Auth::user() ? Auth::user()->email : "" }}" {{ Auth::user() ? "disabled" : "" }} required autocomplete="email" >

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="assunto" class="form-label"> Assunto </label>
                            <input id="assunto" type="assunto" class="form-control" name="assunto" required autocomplete="assunto">
                        </div>

                        <div class="mb-3">
                            <label for="mensagem" class="form-label"> Mensagem </label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="4"></textarea>
                        </div>

                        <div class="direita">
                            <button type="submit" class="btn btn-primary">
                                Enviar Mensagem
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
