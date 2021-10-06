@extends('layouts.consulta_padrao')

@section('titulo', 'Aplicações')

@section('acoes')
    <x-botao_incluir    rota="aplicacao.create" />
    <x-botao_editar     rota="aplicacao.edit"/>
    <x-botao_excluir    rota="aplicacao.destroy"/>
    <x-botao_visualizar rota="aplicacao.show"/>
    @component('funcionalidade.movimentar', ['contas' => $contas]) @endcomponent
    @component('funcionalidade.simular' ) @endcomponent
@endsection

@section('cabecalho') 
    <th scope="col" > Nome </th>
    <th scope="col" > Objetivo </th>
    <th scope="col" > Aplicado Inicial </th>
    <th scope="col" > Aplicado Mensal </th>
    <th scope="col" > Rendimento Anual </th>
    <th scope="col" > Saldo </th>
@endsection

@section('consulta')
@if(count($consulta)> 0)
    @foreach($consulta as $aplicacao)
        <tr id="{{ $aplicacao->id }}">
            <td data-label="Nome">{{ $aplicacao->nome }}</td>
            <td data-label="Objetivo">{{ $aplicacao->objetivo }}</td>
            <td data-label="Aplicado Inicial" data-aplicadoinicial="{{ $aplicacao->aplicadoinicial }}" > {{ $aplicacao->aplicadoinicial }} </td>
            <td data-label="Aplicado Mensal"  data-aplicadomensal="{{ $aplicacao->aplicadomensal }}"   > {{ $aplicacao->aplicadomensal }}  </td>
            <td data-label="Rendimento Anual" data-rendimentoanual="{{ $aplicacao->rendimentoanual }}" > {{ $aplicacao->rendimentoanual }} </td>
            <td data-label="Saldo" data-saldo="{{ $aplicacao->saldo }}" > {{ $aplicacao->saldo }} </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="tabela_vazia">  
            Nenhum registro encontrado
        </td>
    </tr>
@endif
@endsection