<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Conta;
use App\Models\Despesa;
use App\Models\CartaoCredito;
use Illuminate\Http\Request;

class ContasPagarController extends PadraoController {

    protected function pesquisar(Request $request){
        $data = new \stdClass();
        $data->mes = $request->mes;
        $data->ano = $request->ano;

        return $this->index($data);
    }

    protected function index($data = null) {
        if(!$data) {
            $data = new \stdClass();
            $data->mes = intval(date('m'));
            $data->ano = date('Y');
        }

        $despesa = new Despesa();
        $despesa = $despesa->where(self::ID_USUARIO, $this->getUserId());
        $receita = $despesa->whereDate('datavencimento', '>=', Data::getFirstDay($data));
        $receita = $despesa->whereDate('datavencimento', '<=', Data::getLastDay($data));
        $despesa = $despesa->get();

        foreach ($despesa as $registro) {
            $registro->valor = $this->formataValor($registro->valor);
            $registro->datavencimento = $this->formataData($registro->datavencimento);
            $registro->situacao = $this->formataSituacaoDespesa($registro->situacao);
        }

        return view('app.contas_pagar', [  
            'data' => $data,
            'despesa' => $despesa,
            'conta' => $this->getConta()
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

    private function getConta() {
        $conta = new Conta();
        $conta = $conta->where(self::ID_USUARIO, $this->getUserId());
        $conta = $conta->get();

        foreach($conta as $registro){
            $registro->tipo = $this->getTipoConta($registro->tipo);
        }

        return $conta;
    }

    private function getTipoConta($iTipo) {
        $aTipoConta = [
            1 => 'Carteira',
            2 => 'Bancária'
        ];

        return $aTipoConta[$iTipo];
    }

    protected function pagamento(Request $request) {
        $despesa = new Despesa();
        $despesa = $despesa->where('id', $request->id_despesa);
        $despesa = $despesa->where(self::ID_USUARIO, $this->getUserId());
        $despesa = $despesa->get()->first();

        $dados['situacao'] = 1;

        $despesa->update($dados);

        return $this->index();
    }

    protected function cancelar(Request $request) {
        $despesa = new Despesa();
        $despesa = $despesa->where('id', $request->id_despesa);
        $despesa = $despesa->where(self::ID_USUARIO, $this->getUserId());
        $despesa = $despesa->get()->first();

        $dados['situacao'] = 0;

        $despesa->update($dados);

        return $this->index();
    }
}
