<?php

namespace App\Http\Controllers;

use App\Models\CartaoCredito;

class CartaoCreditoController extends PadraoController {
    
    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth'); 
        $this->setModel(new CartaoCredito());
        $this->setNome('Cartão de Crédito');
    }

    protected function trataConsulta($consulta) {
        foreach ($consulta as $cartaocredito) {
            $cartaocredito->limite          = $this->formataValor($cartaocredito->limite);
            $cartaocredito->datavencimento  = $this->formataData($cartaocredito->datavencimento);
            $cartaocredito->bandeira        = $this->getBandeira($cartaocredito->bandeira);
        }

        return $consulta;
    }

    protected function trataDados($dados) {
        $dados['limite'] = $this->formataValor($dados['limite']);
        return $dados;
    }

    protected function processaDados($dados) {
        $dados['limite'] = $this->trataValor($dados['limite']);
        return $dados;
    }

    protected function getRota() {
        return 'cartaocredito';
    }

    protected function getViewConsulta() {
        return 'app.cartao_credito_consulta';
    }

    protected function getViewManutencao() {
        return 'app.cartao_credito_manutencao';
    }

    private function getBandeira($iBandeira) {
        $aBandeiras = [
            1 => 'Mastercard',
            2 => 'Visa',
            3 => 'American Express',
            4 => 'Hipercard',
            5 => 'Elo',
            6 => 'Outro',
        ];

        return $aBandeiras[$iBandeira];
    }

    protected function validaRequest($request){
        return $this->validate($request, [
            'descricao' => ['required', 'string', 'max:100'],
            'titular' => ['required', 'string', 'max:100'],
            'datavencimento' => ['required'],
            'bandeira' => ['required']
        ]);
    }
}
