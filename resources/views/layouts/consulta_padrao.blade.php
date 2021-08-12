@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">  @yield('titulo') </div>
                        <div class="card-body">
                            <div>
                                @yield('navegacao')
                            </div>
                            <div class="btn-toolbar" role="toolbar" style="margin-bottom: 1rem;">
                                @yield('acoes')
                            </div>
                            <table id="tabela_consulta" class="table table-hover">
                                <thead style="background-color: rgb(250, 250, 250)">
                                    <tr>
                                        @yield('cabecalho')
                                    </tr>
                                </thead>
                                <tbody>
                                    @yield('consulta')
                                </tbody>
                            </table>
                             @yield('paginacao')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection