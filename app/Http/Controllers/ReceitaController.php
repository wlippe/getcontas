<?php

namespace App\Http\Controllers;

use App\Models\Receita;

class ReceitaController extends PadraoController {

    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth'); 
        $this->setModel(new Receita());
        $this->setNome('Receita');
    }

    protected function trataConsulta($consulta) {
        foreach ($consulta as $receita) {
            $receita->valor = $this->formataValor($receita->valor);
            $receita->data  = $this->formataData($receita->data);
            $receita->tipo  = $this->getTipoReceita($receita->tipo);
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