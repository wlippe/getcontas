<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Receita;
use App\Models\Data;
use Illuminate\Http\Request;

class ResumoMensalController extends PadraoController {

    public function __construct() {
        $this->middleware('auth'); 
    }

    protected function pesquisar(Request $request){
        $data = new \stdClass();
        $data->mes = $request->mes;
        $data->ano = $request->ano;

        return $this->index($data);
    }

    protected function index($data = null) {
        $this->processaReceitas();

        if(!$data) {
            $data = new \stdClass();
            $data->mes = intval(date('m'));
            $data->ano = date('Y');
        }

        $despesa = $this->getDespesa($data);

        foreach ($despesa as $registro) {
            $registro->valor = $this->formataValor($registro->valor);
            $registro->datavencimento = $this->formataData($registro->datavencimento);
            $registro->situacao_codigo = $registro->situacao;
            $registro->situacao = $this->formataSituacaoDespesa($registro->situacao);

            if ($registro->tipo == 2 ) {
                $registro->parcelas = $registro->parcela.'/'.$registro->parcelastotal;
            }
            
        }

        $receita = $this->getReceita($data);

        foreach ($receita as $registro) {
            $registro->valor    = $this->formataValor($registro->valor);
            $registro->situacao = $this->formataSituacaoReceita($registro);
            $registro->data     = $this->formataData($registro->data);
        }

        $resumomensal = new \stdClass();

        $totalReceita = $this->getTotal($this->getReceita($data));
        $totalDespesa = $this->getTotal($this->getDespesa($data));
        $saldoAPagar  = $this->getSaldoAPagar($data);
        $saldoPago    = $this->getSaldoPago($data);
        $saldoMensal  = $this->getSaldoMensal($data);

        $resumomensal->totalreceita = $this->formataValor($totalReceita);
        $resumomensal->totaldespesa = $this->formataValor($totalDespesa);
        $resumomensal->saldoapagar  = $this->formataValor($saldoAPagar);
        $resumomensal->saldopago    = $this->formataValor($saldoPago);
        $resumomensal->saldomensal  = $this->formataValor($saldoMensal);

        return view('app.resumo_mensal', [  
            'data' => $data,
            'despesa' => $despesa,
            'receita' => $receita,
            'resumomensal' => $resumomensal,
        ]);
    }

    public function formataSituacaoDespesa($situacao) {
        if ($situacao == 1) {
            return 'Pago';
        }
        else {
            return 'A Pagar';
        }
    }

    public function formataSituacaoReceita($registro) {
        $dataAtual = intval(date("Ymd"));

        $ano = substr($registro->data, 0, 4);
        $mes = substr($registro->data, 5, 2);
        $dia = substr($registro->data, 8, 2);

        $dataRegistro = $ano.$mes.$dia;
        $dataRegistro = intval($dataRegistro);

        if ($dataRegistro <= $dataAtual ) {
            return 'Recebido';
        }
        else {
            return 'A Receber';
        }
    }

    private function getDespesa($data) {
        $despesa = new Despesa();
        $despesa = $despesa->where(self::ID_USUARIO, $this->getUserId());
        $despesa = $despesa->whereDate('datavencimento', '>=', Data::getFirstDay($data));
        $despesa = $despesa->whereDate('datavencimento', '<=', Data::getLastDay($data));
        $despesa = $despesa->get();

        return $despesa;
    }

    private function getReceita($data) {
        $receita = new Receita();
        $receita = $receita->where(self::ID_USUARIO, $this->getUserId());
        $receita = $receita->whereDate('data', '>=', Data::getFirstDay($data));
        $receita = $receita->whereDate('data', '<=', Data::getLastDay($data));
        $receita = $receita->get();

        return $receita;
    }

    private function getTotal($colection) {
        $total = 0;

        foreach ($colection as $registro) {
            $total = $total + $registro->valor;
        }

        return $total;
    }

    private function getSaldoAPagar($data) {
        $saldoAPagar = 0;

        $despesa = $this->getDespesa($data);

        foreach ($despesa as $registro) {
            if($registro->situacao != 1) {
                $saldoAPagar = $saldoAPagar + $registro->valor;
            }
        }

        return $saldoAPagar;
    }

    private function getSaldoPago($data) {
        $saldoPago = 0;

        $despesa = $this->getDespesa($data);

        foreach ($despesa as $registro) {
            if($registro->situacao == 1) {
                $saldoPago = $saldoPago + $registro->valor;
            }
        }

        return $saldoPago;
    }

    private function getSaldoMensal($data) {
        $saldoMensal = $this->getTotal($this->getReceita($data)) - $this->getTotal($this->getDespesa($data));

        return $saldoMensal;
    }


}
