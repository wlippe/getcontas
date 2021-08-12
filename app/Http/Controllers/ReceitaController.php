<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends PadraoController {

    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth'); 
        $this->setModel(new Receita());
        $this->setNome('Receita');
    }

    protected function index($data = null) {

        if (!$data) {
            $data = $this->getData();
        }

        $consulta = $this->getModel()->where(self::ID_USUARIO, $this->getUserId());
        $consulta = $consulta->whereDate('data', '>=', Data::getFirstDay($data));
        $consulta = $consulta->whereDate('data', '<=', Data::getLastDay($data));
        $consulta = $consulta->paginate(10);
        $consulta = $this->trataConsulta($consulta);

        return view($this->getViewConsulta(), [
            'consulta' => $consulta,
            'data' => $data,
        ]);
    }

    protected function trataConsulta($consulta) {
        foreach ($consulta as $receita) {
            $receita->valor = $this->formataValor($receita->valor);
            $receita->data  = $this->formataData($receita->data);
            $receita->tipo  = $this->getTipoReceita($receita->tipo);
        }

        return $consulta;
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

    protected function pesquisar(Request $request) {
        $data = new \stdClass();
        $data->mes = $request->mes;
        $data->ano = $request->ano;

        return $this->index($data);
    }

    protected function validaRequest($request){
        return $this->validate($request, [
            'descricao' => ['required', 'string', 'max:50'],
            'data' => ['required'],
            'valor' => ['required'], 
            'tipo'  => ['required', 'integer','gt:0']
        ]);
    }
/*
    protected function processaDados($dados) {
        $dados['valor'] = $this->trataValor($dados['valor']);

        return $dados;
    }
*/
}