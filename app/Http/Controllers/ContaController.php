<?php

namespace App\Http\Controllers;

use App\Models\Conta;
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
            $conta->saldo = $this->formataValor(0);
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
}
