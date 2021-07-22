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

    /**
     * {@inheritdoc}
     */
    protected function trataConsulta($consulta) {
        foreach ($consulta as $aplicacao) {
            $aplicacao->aplicadoinicial = $this->formataValor($aplicacao->aplicadoinicial);
            $aplicacao->aplicadomensal  = $this->formataValor($aplicacao->aplicadomensal);
            $aplicacao->rendimentoanual = $this->formataValor($aplicacao->rendimentoanual);
        }

        return $consulta;
    }

}