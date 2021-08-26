<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class ContaController extends PadraoController {

    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth');
        $this->setModel(new Conta());
        $this->setNome('Conta');
    }

    /**
     * {@inheritdoc}
     */
    protected function trataConsulta($consulta) {
        foreach ($consulta as $conta) {
            $conta->tipo  = $this->getTipoConta($conta->tipo);
            $conta->saldo = $this->formataValor($this->getSaldoConta($conta->id));
        }

        return $consulta;
    }

    private function getTipoConta($iTipo) {
        $aTipoConta = [
            1 => 'Carteira',
            2 => 'Bancária'
        ];

        return $aTipoConta[$iTipo];
    }

    protected function validaRequest($request){
        return $this->validate($request, [
            'nome' => ['required', 'string', 'max:50'],
            'tipo'  => ['required', 'integer','gt:0']
        ]);
    }

    public function getSaldoConta($conta_id) {
        $saldo = 0;

        $extrato = new \App\Models\Extrato();
        $extrato = $extrato->where('conta_id', $conta_id);
        $extrato = $extrato->where(self::ID_USUARIO, $this->getUserId());

        $extratos = $extrato->get();  

        foreach($extratos as $extrato) {
            if($extrato['lancamento'] == 1) {
                $saldo = $saldo + $extrato['valor'];
            }
            else {
                $saldo = $saldo - $extrato['valor'];
            }
            
        }

        $pagamento = new Pagamento();
        $pagamento = $pagamento->where('conta_id', $conta_id);
        $pagamento = $pagamento->where(self::ID_USUARIO, $this->getUserId());

        $pagamentos = $pagamento->get();       

        foreach($pagamentos as $pagamento) {
            $saldo = $saldo - $pagamento['valor'];
        }

        return round($saldo, 2);
    }
}
