<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PadraoController;
use App\Models\Despesa;

class DespesaController extends PadraoController {

    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth'); 
        $this->setModel(new Despesa());
        $this->setNome('Despesa');
    }

    protected function trataConsulta($consulta) {
        foreach ($consulta as $despesa) {
            $despesa->valor = $this->formataValor($despesa->valor);
            $despesa->data  = $this->formataData($despesa->data);
            $despesa->tipo  = $this->getTipoReceita($despesa->tipo);
        }

        return $consulta;
    }

    protected function trataDados($dados) {
        $dados['valor'] = $this->formataValor($dados['valor']);
        return $dados;
    }

    protected function processaDados($dados) {
        $dados['valor'] = $this->trataValor($dados['valor']);
        return $dados;
    }

    /**
     * Retorna o texto do tipo de receita
     */
    private function getTipoReceita($tipo) {
        $lista = [
            1 => 'Pontual',
            2 => 'Semanal',
            3 => 'Mensal',
            4 => 'Anual',
        ];

        return $lista[$tipo];
    }
}