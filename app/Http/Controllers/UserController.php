<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends PadraoController {

    /**
     * Cria uma nova instancia do Controlador.
     */
    public function __construct() {
        $this->middleware('auth');
        $this->setModel(new User());
        $this->setNome('Usuário');
    }

    protected function getViewManutencao() {
        return 'app.usuario';
    }

    /**
     * Exibe recurso específico.
     */
    protected function show(Request $request) {
        $registro = $this->getModel()->where('id', $this->getUserId());
        $registro = $registro->get();

        if ($registro = $registro->first()) {
            $parametro = [
                'titulo'   => 'Meu Perfil',
                'rota'     => $this->getRota().'.update',
                'registro' => $registro,
                'show'     => true
            ];

            return view($this->getViewManutencao(), $parametro);
        }

        return redirect(route($this->getRota()));
    }

    public function nome(Request $request) {
        $parametro = [
                'titulo'   => 'Editar Nome',
                'rota'     => 'usuario.update.nome',
                'registro' => Auth()->user(),
            ];

        return view('app.usuario_nome', $parametro);
    }

    /**
     * Atualiza o nome no banco de dados
     */
    public function updateNome(Request $request) {
        $usuario = $this->getModel()->where('id', $this->getUserId());
        $usuario = $usuario->get();

        $dados = ['name' => $request->name];

        $this->validate($request, ['name' => ['required', 'string', 'max:255']]);

        if (Auth()->user()->update($dados)) {
            return redirect(route('usuario'))->with('success', 'Nome alterado com sucesso!');
        }

        return redirect(route('usuario'))->with('danger', 'Não foi possível alterar o registro!');
    }

    public function senha(Request $request) {
        $parametro = [
                'titulo'   => 'Editar Senha',
                'rota'     => 'usuario.update.senha',
                'registro' => Auth()->user(),
            ];

        return view('app.usuario_senha', $parametro);
    }

    /**
     * Atualiza o senha no banco de dados
     */
    public function updateSenha(Request $request) {
        $usuario = $this->getModel()->where('id', $this->getUserId());
        $usuario = $usuario->get();

        $this->validate($request, [
            'senha_atual' => ['required'],
            'password'    => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($this->validaSenhaAtual($request->senha_atual)) {

            $dados = ['password' => Hash::make($request->password)];
    
            if (Auth()->user()->update($dados)) {
                return redirect(route('usuario'))->with('success', 'Senha alterada com sucesso!');
            }
        }

        return redirect(route('usuario'))->with('danger', 'Não foi possível alterar o registro!');
    }

    public function validaSenhaAtual($senha) {
        return Hash::check($senha, Auth()->user()->password);
    }
}
