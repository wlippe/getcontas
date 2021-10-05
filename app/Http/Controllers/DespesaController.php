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
        $this->processaReceitas();

        if (!$data) {
            $data = $this->getData();
        }

        $consulta = $this->getModel()->where(self::ID_USUARIO, $this->getUserId());
        $consulta = $consulta->whereDate('datavencimento', '>=', Data::getFirstDay($data));
        $consulta = $consulta->whereDate('datavencimento', '<=', Data::getLastDay($data));
        $consulta = $consulta->get();
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

            if ($despesa->tipo == 2) {
                $despesa->parcelas = $despesa->parcela.'/'.$despesa->parcelastotal;
            }

            $despesa->situacao = $this->trataSituacao($despesa->situacao);

            $despesa->tipo = $this->getTipoDespesa($despesa->tipo);
        }

        return $consulta;
    }

    /**
     * Salva a nova despesa no banco de dados.
     */
    protected function store(Request $request) {
        $dados = $request->all();
        $dados['user_id'] = $this->getUserId();

        if($this->validaInclusao($dados)) {

            if($dados['tipo'] == 2){

                for ($indice = 1; $indice <= $dados['parcelastotal']; $indice++) {

                    if($indice > 1) {
                        $dados['datavencimento'] = $this->getProximaData($dados['datavencimento']);
                    }

                    $dados['parcela'] = $indice;

                    Despesa::create($dados);
                }
            }
            else {
                Despesa::create($dados);
            }

            toastr()->success('Registro cadastrado com sucesso!');

            return redirect(route($this->getRota()));
        }

        toastr()->error('Não foi possível cadastrar o registro!');

        return redirect(route($this->getRota()));
    }
/*
    protected function trataDados($dados) {
        //$dados['valor'] = $this->formataValor($dados['valor']);

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
            2 => 'Parcelada',
        ];

        return $lista[$tipo];
    }

    public function trataSituacao($situacao) {
        if ($situacao == 1) {
            return 'Pago';
        }
        else {
            return 'A Pagar';
        }
    }

    protected function pesquisar(Request $request) {
        $data = new \stdClass();
        $data->mes = $request->mes;
        $data->ano = $request->ano;

        return $this->index($data);
    }

    public function getProximaData($data) {
        $dia = Data::extractDay($data);
        $mes = Data::extractMonth($data);
        $ano = Data::extractYear($data);
        
        if (intval($dia) > intval(Data::getLastDayInMonth($mes+1))) {
            $dia = Data::getLastDayInMonth($mes+1);
        }

        $data = '20'.$ano.'-'.$this->trataDigito($mes).'-'.$this->trataDigito($dia);

        return Data::addMes($data, 1);
    }
}