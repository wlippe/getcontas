@extends('layouts.consulta_padrao')

@section('titulo') Receitas @endsection

@section('navegacao')
    @component('components.navegacao', ['rota' => 'receita.pesquisar', 'data' => $data ]) @endcomponent
@endsection

@section('acoes')
    <x-botao_incluir    rota="receita.create" />
    <x-botao_editar     rota="receita.edit"/>
    <x-botao_excluir    rota="receita.destroy"/>
    <x-botao_visualizar rota="receita.show"/>
@endsection

@section('cabecalho') 
    <th scope="col">Descrição </th>
    <th scope="col">Data</th>
    <th scope="col">Tipo</th>
    <th scope="col">Valor</th>
@endsection

@section('consulta')
@if($consulta->total() > 0)
    @foreach($consulta as $receita)
        <tr id="{{ $receita->id }}">
            <td data-label="Descrição">{{ $receita->descricao }}</td>
            <td data-label="Data">{{ $receita->data }} </td>
            <td data-label="Tipo">{{ $receita->tipo }} </td>
            <td data-label="Valor" class="money">{{ $receita->valor }} </td>
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