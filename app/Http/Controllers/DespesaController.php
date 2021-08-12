<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Despesa;
use Illuminate\Http\Request;

class DespesaController extends PadraoController {

    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth'); 
        $this->setModel(new Despesa());
        $this->setNome('Despesa');
    }

    protected function index($data = null) {

        if (!$data) {
            $data = $this->getData();
        }

        $consulta = $this->getModel()->where(self::ID_USUARIO, $this->getUserId());
        $consulta = $consulta->whereDate('datavencimento', '>=', Data::getFirstDay($data));
        $consulta = $consulta->whereDate('datavencimento', '<=', Data::getLastDay($data));
        $consulta = $consulta->paginate(10);
        $consulta = $this->trataConsulta($consulta);

        return view($this->getViewConsulta(), [
            'consulta' => $consulta,
            'data' => $data,
        ]);
    }

    protected function trataConsulta($consulta) {
        foreach ($consulta as $despesa) {
            $despesa->valor = $this->formataValor($despesa->valor);
            $despesa->datavencimento = $this->formataData($despesa->datavencimento);
            $despesa->tipo = $this->getTipoDespesa($despesa->tipo);
        }

        return $consulta;
    }
/*
    protected function trataDados($dados) {
        $dados['valor'] = $this->formataValor($dados['valor']);
        return $dados;
    }

    protected function processaDados($dados) {
        $dados['valor'] = $this->trataValor($dados['valor']);
        return $dados;
    }
*/
    protected function validaRequest($request){
        return $this->validate($request, [
            'descricao' => ['required', 'string', 'max:50'],
            'datavencimento' => ['required'],
            'valor' => ['required'], 
            'tipo'  => ['required', 'integer','gt:0']
        ]);
    }

    /**
     * Retorna o texto do tipo de despesa
     */
    private function getTipoDespesa($tipo) {
        $lista = [
            1 => 'Pontual',
            2 => 'Mensal',
            3 => 'Parcelada',
        ];

        return $lista[$tipo];
    }

    protected function pesquisar(Request $request) {
        $data = new \stdClass();
        $data->mes = $request->mes;
        $data->ano = $request->ano;

        return $this->index($data);
    }
}