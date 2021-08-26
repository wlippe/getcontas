@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">  Contas a Pagar </div>
                        <div class="card-body">

                            @component('components.navegacao', ['rota' => 'contas.pagar.pesquisar', 'data' => $data ]) @endcomponent

                            <table id="tabela_consulta" class="table table-hover">
                                <thead style="background-color: rgb(250, 250, 250)">
                                    <tr>
                                        <th scope="col" > Descrição  </th>
                                        <th scope="col" > Data       </th>
                                        <th scope="col" > Parcelas   </th>
                                        <th scope="col" > Valor      </th>
                                        <th scope="col" > Situação   </th>
                                        <th scope="col" style="width:9%; text-align:center"> Ações  </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if($despesa)
                                        @foreach($despesa as $registro)
                                            <tr id="{{ $registro->id }}">
                                                <td data-label="Descrição"> {{ $registro->descricao }} </td>
                                                <td data-label="Data"> {{ $registro->datavencimento }} </td>
                                                <td data-label="Parcelas"> {{ $registro->parcelas }} </td>
                                                <td data-label="valor" > {{ $registro->valor }} </td>
                                                <td data-label="Situação"> {{ $registro->situacao }} </td>
                                                <td data-label="Ações">
                                                    @if($registro->situacao == 'Pago')
                                                        @component('components.botao_cancelar_pagamento', ['id' => $registro->id ]) @endcomponent
                                                    @else
                                                        @component('components.botao_pagar', ['data' => $data, 'conta' => $conta, 'id' => $registro->id ]) @endcomponent
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection