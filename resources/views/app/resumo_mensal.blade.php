@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">  Resumo Mensal </div>
                        <div class="card-body">
                         <form method="POST" action="{{ route('resumo.mensal.pesquisar') }}">
                         @csrf
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <select class="form-select" id="mes" name="mes">
                                        <option value="1"  {{$data->mes == 1 ?  "selected='selected'" : ""}} > Janeiro </option>
                                        <option value="2"  {{$data->mes == 2 ?  "selected='selected'" : ""}} > Fevereiro </option>
                                        <option value="3"  {{$data->mes == 3 ?  "selected='selected'" : ""}} > Março </option>
                                        <option value="4"  {{$data->mes == 4 ?  "selected='selected'" : ""}} > Abril </option>
                                        <option value="5"  {{$data->mes == 5 ?  "selected='selected'" : ""}} > Maio </option>
                                        <option value="6"  {{$data->mes == 6 ?  "selected='selected'" : ""}} > Junho </option>
                                        <option value="7"  {{$data->mes == 7 ?  "selected='selected'" : ""}} > Julho </option>
                                        <option value="8"  {{$data->mes == 8 ?  "selected='selected'" : ""}} > Agosto </option>
                                        <option value="9"  {{$data->mes == 9 ?  "selected='selected'" : ""}} > Setembro </option>
                                        <option value="10" {{$data->mes == 10 ? "selected='selected'" : ""}} > Outubro </option>
                                        <option value="11" {{$data->mes == 11 ? "selected='selected'" : ""}} > Novembro </option>
                                        <option value="12" {{$data->mes == 12 ? "selected='selected'" : ""}} > Dezembro </option>
                                    </select>
                                    <select class="form-select" id="ano" name="ano">
                                        <option value="{{ $data->ano-2 }}" {{$data->ano == $data->ano-2 ? "selected='selected'" : ""}} > {{ $data->ano-2 }} </option>
                                        <option value="{{ $data->ano-1 }}" {{$data->ano == $data->ano-1 ? "selected='selected'" : ""}} > {{ $data->ano-1 }} </option>
                                        <option value="{{ $data->ano }}"   {{$data->ano == $data->ano   ? "selected='selected'" : ""}} > {{ $data->ano }}   </option>
                                        <option value="{{ $data->ano+1 }}" {{$data->ano == $data->ano+1 ? "selected='selected'" : ""}} > {{ $data->ano+1 }} </option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                            </form>

                            <table id="tabela_consulta" class="table table-hover">
                                <thead style="background-color: rgb(250, 250, 250)">
                                    <tr>
                                        <th scope="col" > Descrição  </th>
                                        <th scope="col" > Data       </th>
                                        <th scope="col" > Valor      </th>
                                        <th scope="col" > Situação   </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($receita as $registro)
                                        <tr id="{{ $registro->id }}" style="color:green">
                                            <td data-label="Descrição"> {{ $registro->descricao }} </td>
                                            <td data-label="Data"> {{ $registro->data }} </td>
                                            <td data-label="valor"> {{ $registro->valor }} </td>
                                            <td data-label="Situação"> {{ $registro->situacao }} </td>
                                            
                                        </tr>
                                    @endforeach

                                    @if($despesa)
                                        @foreach($despesa as $registro)
                                            <tr id="{{ $registro->id }}" style="color:red">
                                                <td data-label="Descrição"> {{ $registro->descricao }} </td>
                                                <td data-label="Data"> {{ $registro->datavencimento }} </td>
                                                <td data-label="valor" > {{ $registro->valor }} </td>
                                                <td data-label="Situação"> {{ $registro->situacao }} </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>

                            <div style="padding-top:2rem">
                                <div class="card" style="padding:1rem;">

                                    <table id="tabela_consulta">
                                        <tr>
                                            <td data-label="Total Receita:"> Total Receita: </td>
                                            <td style="float:right;" > {{ $resumomensal->totalreceita }}  </td>
                                            <td style="width:30%;"> </td>
                                            <td data-label="Saldo A Pagar:"> Saldo A Pagar: </td>
                                            <td style="float:right;"> {{ $resumomensal->saldoapagar }} </td>
                                        </tr>
                                    <tr>
                                        <td data-label="Total Despesa:"> Total Despesa: </td>
                                        <td style="float:right;"> {{ $resumomensal->totaldespesa }} </td>
                                        <td style="width:30%;"> </td>
                                        <td data-label="Saldo Pago:"> Saldo Pago: </td>
                                        <td style="float:right;"> {{ $resumomensal->saldopago }} </td>
                                    </tr>

                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td style="width:30%;"> </td>
                                        <td data-label="Saldo Mensal:"> Saldo Mensal: </td>
                                        <td style="float:right;"> {{ $resumomensal->saldomensal }} </td>
                                    </tr>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection