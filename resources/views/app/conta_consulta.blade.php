@extends('layouts.consulta_padrao')

@section('titulo', 'Contas')

@section('acoes')
    <x-botao_incluir    rota="conta.create" />
    <x-botao_editar     rota="conta.edit"/>
    <x-botao_excluir    rota="conta.destroy"/>
    <x-botao_visualizar rota="conta.show"/>
@endsection

@section('cabecalho') 
    <th scope="col" > Nome      </th>
    <th scope="col" > Descrição </th>
    <th scope="col" > Tipo      </th>
    <th scope="col" > Saldo     </th>
@endsection

@section('consulta')
@if(count($consulta) > 0)
    @foreach($consulta as $conta)
        <tr id="{{ $conta->id }}" name="consulta">
            <td data-label="Nome"> {{ $conta->nome }}      </td>
            <td data-label="Descrição"> {{ $conta->descricao }} </td>
            <td data-label="Tipo"> {{ $conta->tipo }}      </td>
            <td data-label="Saldo"> {{ $conta->saldo }} </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="4" class="tabela_vazia">  
            Nenhum registro encontrado
        </td>
    </tr>
@endif
@endsection