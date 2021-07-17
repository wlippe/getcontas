@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Receitas</div>
                        <div class="card-body">
                            <div class="btn-toolbar" role="toolbar" style="margin-bottom: 1rem;">
                                <x-botao_incluir    rota="receita.create" />
                                <x-botao_editar     rota="receita.edit"/>
                                <x-botao_excluir    rota="receita.destroy"/>
                                <x-botao_visualizar rota="receita.show"/>
                            </div>
                            <table id="tabela_consulta" class="table table-hover">
                                <thead style="background-color: rgb(250, 250, 250)">
                                    <tr>
                                        <th scope="col"                    >Descrição </th>
                                        <th scope="col" style="width: 16rem">Data</th>
                                        <th scope="col" style="width: 16rem">Tipo</th>
                                        <th scope="col" style="width: 6rem">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if($consulta->total() > 0)
                                        @foreach($consulta as $receita)
                                            <tr id="{{ $receita->id }}">
                                                <td>{{ $receita->descricao }}</td>
                                                <td>{{ $receita->data }} </td>
                                                <td>{{ $receita->tipo }} </td>
                                                <td class="money">{{ $receita->valor }} </td>
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
    </div>
@endsection