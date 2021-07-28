@extends('layouts.consulta_padrao')

@section('titulo', 'Cartão de Crédito')

@section('acoes')
    <x-botao_incluir    rota="cartaocredito.create" />
    <x-botao_editar     rota="cartaocredito.edit"/>
    <x-botao_excluir    rota="cartaocredito.destroy"/>
    <x-botao_visualizar rota="cartaocredito.show"/>
@endsection

@section('cabecalho') 
    <th scope="col" > Descrição  </th>
    <th scope="col" > Titular </th>
    <th scope="col" > Data Vencimento </th>
    <th scope="col" > Bandeira </th>
    <th scope="col" > Dígitos </th>
    <th scope="col" > Limite </th>
@endsection

@section('consulta')

@if($consulta->total() > 0)
    @foreach($consulta as $registro)
        <tr id="{{ $registro->id }}">
            <td data-label="Descrição"> {{ $registro->descricao }} </td>
            <td data-label="Titular"  {{ $registro->titular }} </td>
            <td data-label="Data Vencimento" > {{ $registro->datavencimento }} </td>
            <td data-label="Bandeira" > {{ $registro->bandeira }} </td>
            <td data-label="Dígitos" > {{ $registro->digitos }} </td>
            <td data-label="Limite" class="money" > {{ $registro->limite }} </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="tabela_vazia">  
            Nenhum registro encontrado
        </td>
    </tr
@endif
@endsection

@section('paginacao')
    @component('components.paginacao', ['consulta' => $consulta]) @endcomponent
@endsection