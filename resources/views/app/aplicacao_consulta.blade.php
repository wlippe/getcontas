@extends('layouts.consulta_padrao')

@section('titulo', 'Aplicações')

@section('acoes')
    <x-botao_incluir    rota="aplicacao.create" />
    <x-botao_editar     rota="aplicacao.edit"/>
    <x-botao_excluir    rota="aplicacao.destroy"/>
    <x-botao_visualizar rota="aplicacao.show"/>
    @component('funcionalidade.simular') @endcomponent
@endsection

@section('cabecalho') 
    <th scope="col" > Nome </th>
    <th scope="col" > Objetivo </th>
    <th scope="col" > Aplicado Inicial </th>
    <th scope="col" > Aplicado Mensal </th>
    <th scope="col" > Rendimento Anual </th>
@endsection

@section('consulta')
@if($consulta->total() > 0)
    @foreach($consulta as $aplicacao)
        <tr id="{{ $aplicacao->id }}">
            <td>{{ $aplicacao->nome }}</td>
            <td>{{ $aplicacao->objetivo }}</td>
            <td class="money">{{ $aplicacao->aplicadoinicial }} </td>
            <td class="money">{{ $aplicacao->aplicadomensal }} </td>
            <td class="money">{{ $aplicacao->rendimentoanual }} </td>
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

@section('paginacao')
    @component('components.paginacao', ['consulta' => $consulta]) @endcomponent
@endsection