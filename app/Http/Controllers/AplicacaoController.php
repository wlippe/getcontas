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
            $aplicacao->rendimento = $this->formataValor($aplicacao->rendimento);
            $aplicacao->metamensal = $this->formataValor($aplicacao->metamensal);
            $aplicacao->metafinal  = $this->formataValor($aplicacao->metafinal);
        }

        return $consulta;
    }

}