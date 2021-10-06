<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class PadraoController extends Controller {

    const ID_USUARIO = 'user_id';
    const CREDITO    = 1;
    const DEBITO     = 2;

    protected $Model;
    protected $nome;

    /**
     * Realiza a busca no banco de dados para o usuário logado.
     * Renderiza a view de consulta.
     */
    protected function index() {
        $this->processaReceitas();

        $consulta = $this->getModel()->where(self::ID_USUARIO, $this->getUserId());
        $consulta = $consulta->get();
        $consulta = $this->trataConsulta($consulta);

        return view($this->getViewConsulta(), ['consulta' => $consulta]);
    }

    /**
     * Exibe o formulário de cadastro de receita.
     */
    protected function create() {
        $parametro = [
            'titulo'   => 'Cadastrar '.$this->getNome(),
            'rota'     => $this->getRota().'.store',
            'registro' => $this->getModel(),
            'show'     => false
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
                'show'     => true
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
                'show'     => false
            ];

            return view($this->getViewManutencao(), $parametro);
        }

        return redirect(route($this->getRota()));
    }

    /**
     * Atualiza o registro no banco de dados
     */
    protected function update(Request $request) {
        $this->validaRequest($request);

        $registro = $this->getModel()->where('id', $request->id);
        $registro = $registro->where(self::ID_USUARIO, $this->getUserId());
        $registro = $registro->get();

        if ($registro = $registro->first()) {
            $dados = $request->all();
            $dados = $this->processaDados($dados);
            $dados = $this->processaDadosAlteracao($dados);

            if ($this->validaAlteracao($request)) {
                $registro->update($dados);

                toastr()->success('Registro alterado com sucesso!');

                return redirect(route($this->getRota()));
            }

        }

        toastr()->error('Não foi possível alterar o registro!');

        return redirect(route($this->getRota()));
    }

    /**
     * Deleta o registro do banco de dados
     */
    protected function destroy(Request $request) {
        $registro = $this->getModel()->where('id', $request->id_excluir);
        $registro = $registro->where(self::ID_USUARIO, $this->getUserId());
        $registro = $registro->get();       

        if ($dados = $registro->first()) {

            if($this->validaExclusao($dados)) {
                $dados = $this->processaDadosExclusao($dados);

                $dados->delete();

                toastr()->success('Registro excluído com sucesso!');

                return redirect(route($this->getRota()));
            }

        }

        toastr()->error('Não foi possível excluir o registro!');

        return redirect(route($this->getRota()));
    }

    /**
     * Retorna o Id do Usuário logado
     */
    protected function getUserId() {
            return Auth()->user()->id;
    }

    /**
     * Formata a data para o padrão dia/mes/ano
     */
    protected function formataData($data) {
        return \Carbon\Carbon::parse($data)->format('d/m/Y');
    }

    /**
     * Formata um valor para o padrão monetário
     * $decimais  = Número de casas decimais
     * $dec_point = Separador da casa decimal
     * $mil_point = Separador da casa de milhar
     */
    protected function formataValor($valor, $decimais = 2, $dec_point = ",", $mil_point = false) {
        return number_format($valor, $decimais, $dec_point, $mil_point);
    }

    protected function validaAcesso($id) {
        if (!($id = $this->getUserId())) {
            return view('acesso_negado');
        }
    }

    protected function setModel($Model) {
        $this->Model = $Model;
    }

    protected function setNome($nome) {
        $this->nome = $nome;
    }

    protected function getModel() {
        return $this->Model;
    }

    protected function getNome() {
        return $this->nome;
    }

    protected function getViewConsulta() {
        return 'app.'.$this->getRota().'_consulta';
    }

    protected function getViewManutencao() {
        return 'app.'.$this->getRota().'_manutencao';
    }

    protected function getRota() {
        $rota = $this->removeAcento($this->getNome());

        return strtolower($rota);
    }

    private function removeAcento($string) {
        $novastring = preg_replace( [
            "/(á|à|ã|â|ä)/",
            "/(Á|À|Ã|Â|Ä)/",
            "/(é|è|ê|ë)/",
            "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/",
            "/(ó|ò|õ|ô|ö)/",
            "/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/",
            "/(ç)/","/(Ç)/",
            "/(ñ)/","/(Ñ)/"
        ],
            explode(" ","a A e E i I o O u U c C n N"),
            $string);

        return $novastring;
    }

    protected function trataValor($valor) {
        $valorTratado = str_replace('.', '',  $valor); // remove o ponto
        $valorTratado = str_replace(',', '.', $valor); // troca a vírgula por ponto

        return $valorTratado;
    }

    /**  Início dos métodos que serão utilizados pelos filhos para realizar tratamentos especícicos nas ações padrão **/

    /**
     * Realiza tratamento nos registros da consulta
     */
    protected function trataConsulta($consulta) { 
        return $consulta;
    }

    /**
     * Realiza tratamento nos registros da tela de manutenção
     */
    protected function trataDados($dados) { 
        return $dados;
    }

    /**
     * Realiza tratamento no registro para inclusão
     */
    protected function processaDados($dados) { 
        return $dados;
    }

    /**
     * Realiza tratamento no registro para inclusão
     */
    protected function processaDadosInclusao($dados) { 
        return $dados;
    }

    /**
     * Realiza tratamento no registro para alteração
     */
    protected function  processaDadosAlteracao($dados) { 
        return $dados;
    }

    /**
     * Realiza tratamento no registro para exclusão
     */
    protected function processaDadosExclusao($dados) { 
        return $dados;
    }

    /**
     * Realiza validações no registro para inclusão
     */
    protected function validaInclusao($dados) {
        return true;
    }

    /**
     * Realiza validações no registro para alteração
     */
    protected function validaAlteracao($dados) {
        return true;
    }

    /**
     * Realiza validações no registro para exclusão
     */
    protected function validaExclusao($dados) {
        return true;
    }

    protected function validaRequest(Request $request) {
        return true;
    }

    protected function getData() {
        $data = new \stdClass();
        $data->dia = intval(date('d'));
        $data->mes = intval(date('m'));
        $data->ano = date('Y');
        
        return $data;
    }

    protected function getDataAtual() {
        return date('Y/m/d');
    }

    protected function trataDigito($digito) {
        if($digito < 10){
            return '0'.$digito;
        }

        return $digito;
    }

    protected function processaReceitas() {
        $receita = new \App\Models\Receita();
        $receita = $receita->where(self::ID_USUARIO, $this->getUserId());

        $receitas = $receita->get();

        foreach($receitas as $receita) {
            $this->verificaReceitaAlterada($receita);
    
            if ($this->comparaDatas($receita->data, false, true)) {
                $extrato = new \App\Models\Extrato();
                $extrato = $extrato->where(self::ID_USUARIO, $this->getUserId());
                $extrato = $extrato->where('receita_id', $receita->id);

                if (!$extrato->get()->first()) {
                    $dados['receita_id'] = $receita->id ;
                    $dados['conta_id']   = $receita->conta_id ;
                    $dados['user_id']    = $receita->user_id;
                    $dados['valor']      = $receita->valor;
                    $dados['lancamento'] = self::CREDITO;
                    $dados['data']       = $receita->data ;

                    $newExtrato = new \App\Models\Extrato();
                    $newExtrato->create($dados);
                }
            }
        }
    }

    protected function verificaReceitaAlterada($receita) {
        $extrato = new \App\Models\Extrato();
        $extrato = $extrato->where(self::ID_USUARIO, $this->getUserId());
        $extrato = $extrato->where('receita_id', $receita->id);
        
        if($extrato = $extrato->get()->first() ) {
            if ($extrato->conta_id != $receita->conta_id) {
                $extrato->update(['conta_id' => $receita->conta_id]);
            }

            if ($extrato->valor != $receita->valor) {
                $extrato->update(['valor' => $receita->valor]);
            }

            if ($extrato->data != $receita->data) {
                if (!$this->comparaDatas($receita->data, false, true)) {
                    $extrato->delete();
                }
                else {
                    $extrato->update(['data' => $receita->data]);
                }
            }
        }
    }

    /*
     * Retorna se a primeira Data é menor que a segunda.
     */
    private function comparaDatas($data1, $data2 = false, $consideraIgual = false) {
        $ano = substr($data1, 0, 4);
        $mes = substr($data1, 5, 2);
        $dia = substr($data1, 8, 2);

        $data1 = $ano.$mes.$dia;
        $data1 = intval($data1);

        if($data2) {
            $ano = substr($data2, 0, 4);
            $mes = substr($data2, 5, 2);
            $dia = substr($data2, 8, 2);
    
            $data2 = $ano.$mes.$dia;
            $data2 = intval($data2);
        }
        else {
            $dataAtual = intval(date("Ymd"));
            $data2     = $dataAtual;
        }

        if ($consideraIgual) {
            return $data1 <= $data2;
        }

        return $data1 < $data2;
    }
}