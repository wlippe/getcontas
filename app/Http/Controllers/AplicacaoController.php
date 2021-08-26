<?php

namespace App\Http\Controllers;

use App\Models\Aplicacao;

class AplicacaoController extends PadraoController {

    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth');
        $this->setModel(new Aplicacao());
        $this->setNome('Aplicação');
    }

    protected function index() {
        $this->processaReceitas();

        $consulta = $this->getModel()->where(self::ID_USUARIO, $this->getUserId());
        $consulta = $consulta->paginate(10);
        $consulta = $this->trataConsulta($consulta);

        return view($this->getViewConsulta(), [
            'consulta' => $consulta,
            'contas'   => $this->getContas(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function trataConsulta($consulta) {
        foreach ($consulta as $aplicacao) {
            $aplicacao->aplicadoinicial = $this->formataValor($aplicacao->aplicadoinicial);
            $aplicacao->aplicadomensal  = $this->formataValor($aplicacao->aplicadomensal);
            $aplicacao->rendimentoanual = $this->formataValor($aplicacao->rendimentoanual);
            $aplicacao->saldo           = $this->formataValor($this->getSaldoAplicacao($aplicacao->id));
        }

        return $consulta;
    }

    protected function movimentar(\Illuminate\Http\Request $request) {
        $aplicacao = new \App\Models\Aplicacao();
        $aplicacao = $aplicacao->where(self::ID_USUARIO, $this->getUserId());
        $aplicacao = $aplicacao->where('id', $request->id_movimentar);

        if ($aplicacao->get()->first()) {
            $dados['aplicacao_id'] = $request->id_movimentar ;
            $dados['user_id']      = $this->getUserId();
            $dados['valor']        = $request->valor;
            $dados['lancamento']   = $request->tipo;
            $dados['data']         = $request->data ;

            $newExtrato = new \App\Models\Extrato();
            $newExtrato->create($dados);

            $dados['aplicacao_id'] = null;
            $dados['conta_id']     = $request->conta_id;
            $dados['lancamento']   = $request->tipo == '1'? self::DEBITO : self::CREDITO;

            $newExtrato = new \App\Models\Extrato();
            $newExtrato->create($dados);

            if($request->tipo == self::CREDITO){
                toastr()->success('Aplicação realizada com sucesso!');
            }
            else {
                toastr()->success('Resgate realizado com sucesso!');
            }
        }
        else {
            toastr()->error('Não foi possível realizar a movimentação!');
        }

        return redirect(route($this->getRota()));
    }

    public function getSaldoAplicacao($aplicacao_id) {
        $saldo = 0;

        $extrato = new \App\Models\Extrato();
        $extrato = $extrato->where('aplicacao_id', $aplicacao_id);
        $extrato = $extrato->where(self::ID_USUARIO, $this->getUserId());

        $extratos = $extrato->get();  

        foreach($extratos as $extrato) {
            if($extrato->lancamento == self::CREDITO) {
                $saldo = $saldo + $extrato['valor'];
            }
            else {
                $saldo = $saldo - $extrato['valor'];
            }
        }

        return round($saldo, 2);
    }

    private function getContas() {
        $conta = new \App\Models\Conta();
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
}