@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Aplicações </div>

                    <div class="card-body">

                        <div class="btn-toolbar" role="toolbar" style="margin-bottom: 1rem;">
                            <x-botao_incluir    rota="aplicacao.create" />
                            <x-botao_editar     rota="aplicacao.edit"/>
                            <x-botao_excluir    rota="aplicacao.destroy"/>
                            <x-botao_visualizar rota="aplicacao.show"/>

                            @component('funcionalidade.simular') @endcomponent
                        </div>

                        <table id="tabela_consulta" class="table table-hover">
                            <thead style="background-color: rgb(250, 250, 250)">
                                <tr>
                                    <th scope="col" class="s-6">Nome </th>
                                    <th scope="col" class="s-10">Objetivo</th>
                                    <th scope="col" class="s-2">Rendimento Anual</th>
                                    <th scope="col" class="s-2">Meta Mensal</th>
                                    <th scope="col" class="s-2">Meta Final</th>
                                </tr>
                            </thead>
                            <tbody>
                               @if($consulta->total() > 0)
                                    @foreach ($consulta as $aplicacao)
                                        <tr id="{{ $aplicacao->id }}">
                                            <td>{{ $aplicacao->nome }}</td>
                                            <td>{{ $aplicacao->objetivo }}</td>
                                            <td>{{ $aplicacao->rendimento }} </td>
                                            <td>{{ $aplicacao->metamensal }} </td>
                                            <td>{{ $aplicacao->metafinal }} </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="tabela_vazia">  
                                            Nenhum registro encontrado
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    @component('components.paginacao', ['consulta' => $consulta]) @endcomponent

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection