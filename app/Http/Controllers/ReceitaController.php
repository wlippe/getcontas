<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Conta;
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
        $this->processaReceitas();

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
            'data' => $data
        ]);
    }

    /**
     * Exibe o formulário de cadastro de receita.
     */
    protected function create() {
        $parametro = [
            'titulo'   => 'Cadastrar '.$this->getNome(),
            'rota'     => $this->getRota().'.store',
            'registro' => $this->getModel(),
            'show'     => false,
            'contas'   => $this->getConta()
        ];

        return view($this->getViewManutencao(), $parametro);
    }

    /**
     * Salva o registro no banco de dados.
     */
    protected function store(Request $request) {
        $this->validaRequest($request);

        $dados = $request->all();
        $dados['user_id'] = $this->getUserId();

        $dados = $this->processaDados($dados);
        $dados = $this->processaDadosInclusao($dados);

        if($this->validaInclusao($dados)) {
            $this->getModel()->create($dados);

            toastr()->success('Registro cadastrado com sucesso!');

            return redirect(route($this->getRota()));
        }

        toastr()->error('Não foi possível cadastrar o registro!');

        return redirect(route($this->getRota()));
    }

    /**
     * Exibe recurso específico.
     */
    protected function show(Request $request) {
        $registro = $this->getModel()->where('id', $request->id_visualizar);
        $registro = $registro->where(self::ID_USUARIO, $this->getUserId());
        $registro = $registro->get();

        if ($registro = $registro->first()) {
            $registro = $this->trataDados($registro);

            $parametro = [
                'titulo'   => 'Visualizar '.$this->getNome(),
                'rota'     => $this->getRota().'.update',
                'registro' => $registro,
                'show'     => true,
                'contas'    => $this->getConta()
            ];

            return view($this->getViewManutencao(), $parametro);
        }

        return redirect(route($this->getRota()));
    }

    /**
     * Exibe o formulário para edição do registro
     */
    protected function edit(Request $request) {
        $registro = $this->getModel()->where('id', $request->id_editar);
        $registro = $registro->where(self::ID_USUARIO, $this->getUserId());
        $registro = $registro->get();

        if ($registro = $registro->first()) {
            $registro = $this->trataDados($registro);

            $parametro = [
                'titulo'   => 'Editar '.$this->getNome(),
                'rota'     => $this->getRota().'.update',
                'registro' => $registro,
                'show'     => false,
                'contas'    => $this->getConta()
            ];

            return view($this->getViewManutencao(), $parametro);
        }

        return redirect(route($this->getRota()));
    }

    protected function trataConsulta($consulta) {
        foreach ($consulta as $receita) {
            $receita->valor = $this->formataValor($receita->valor);
            $receita->data  = $this->formataData($receita->data);
        }

        return $consulta;
    }

    protected function pesquisar(Request $request) {
        $data = new \stdClass();
        $data->mes = $request->mes;
        $data->ano = $request->ano;

        return $this->index($data);
    }

    protected function validaRequest($request){
        return $this->validate($request, [
            'data' => ['required'],
            'valor' => ['required'],
            'conta_id' => ['required'],
        ]);
    }

    private function getConta() {
        $conta = new Conta();
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