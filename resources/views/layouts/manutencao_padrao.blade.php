@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> @yield('titulo') </div>
                    <div class="card-body">
                        @yield('formulario')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection