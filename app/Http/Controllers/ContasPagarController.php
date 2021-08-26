<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Conta;
use App\Models\Despesa;
use App\Models\CartaoCredito;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class ContasPagarController extends PadraoController {

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

        $despesa = new Despesa();
        $despesa = $despesa->where(self::ID_USUARIO, $this->getUserId());
        $receita = $despesa->whereDate('datavencimento', '>=', Data::getFirstDay($data));
        $receita = $despesa->whereDate('datavencimento', '<=', Data::getLastDay($data));
        $despesa = $despesa->get();

        foreach ($despesa as $registro) {
            $registro->valor = $this->formataValor($registro->valor);
            $registro->datavencimento = $this->formataData($registro->datavencimento);
            $registro->situacao = $this->formataSituacaoDespesa($registro->situacao);
            
            if ($registro->tipo == 2 ) {
                $registro->parcelas = $registro->parcela.'/'.$registro->parcelastotal;
            }
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
        $despesa = $despesa->where('id', $request->despesa_id);
        $despesa = $despesa->where(self::ID_USUARIO, $this->getUserId());
        
        if($despesa = $despesa->get()->first()) {

            $pagamento = $request->all();
            $pagamento['user_id'] = $this->getUserId();
            $pagamento['valor']   = $despesa->valor;

            Pagamento::create($pagamento);

            $dados['situacao'] = 1;

            $despesa->update($dados);

            toastr()->success('Pagamento realizado!');

            return $this->index();
        }

        toastr()->error('Ocorreu um erro ao realizar o pagamento!');

        return $this->index();
    }

    protected function cancelar(Request $request) {
        $pagamento = new Pagamento();
        $pagamento = $pagamento->where('despesa_id', $request->id_despesa_cancelar);
        $pagamento = $pagamento->where(self::ID_USUARIO, $this->getUserId());
        $pagamento = $pagamento->get();       

        if ($pagamento = $pagamento->first()) {
            $pagamento->delete();

            $despesa = new Despesa();
            $despesa = $despesa->where('id', $request->id_despesa_cancelar);
            $despesa = $despesa->where(self::ID_USUARIO, $this->getUserId());
            $despesa = $despesa->get()->first();
    
            $dados['situacao'] = 0;
    
            $despesa->update($dados);
    
            toastr()->warning('Pagamento Cancelado!');
    
            return $this->index();
        }

        toastr()->error('Ocorreu um erro ao cancelar o pagamento!');

        return $this->index();
    }
}
