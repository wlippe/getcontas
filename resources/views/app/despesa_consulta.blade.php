@extends('layouts.consulta_padrao')

@section('titulo', 'Despesa')

@section('navegacao')
    @component('components.navegacao', ['rota' => 'despesa.pesquisar', 'data' => $data ]) @endcomponent
@endsection

@section('acoes')
    <x-botao_incluir    rota="despesa.create" />
    <x-botao_editar     rota="despesa.edit"/>
    <x-botao_excluir    rota="despesa.destroy"/>
    <x-botao_visualizar rota="despesa.show"/>
@endsection

@section('cabecalho') 
    <th scope="col" > Descrição  </th>
    <th scope="col" > Data Vencimento </th>
    <th scope="col" > Parcelas </th>
    <th scope="col" > Tipo </th>
    <th scope="col" > Situação </th>
    <th scope="col" > Valor </th>
@endsection

@section('consulta')
@if($consulta->total() > 0)
    @foreach($consulta as $registro)
        <tr id="{{ $registro->id }}">
            <td data-label="Descrição"> {{ $registro->descricao }} </td>
            <td data-label="Data Vencimento"> {{ $registro->datavencimento }} </td>
            <td data-label="Parcelas"> {{ $registro->parcelas }} </td>
            <td data-label="Tipo"> {{ $registro->tipo }} </td>
            <td data-label="Situação"> {{ $registro->situacao }} </td>
            <td data-label="valor"> {{ $registro->valor }} </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6" class="tabela_vazia">  
            Nenhum registro encontrado
        </td>
    </tr
@endif
@endsection

@section('paginacao')
    @component('components.paginacao', ['consulta' => $consulta]) @endcomponent
@endsection