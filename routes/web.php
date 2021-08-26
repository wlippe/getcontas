<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\AplicacaoController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\CartaoCreditoController;
use App\Http\Controllers\ResumoMensalController;
use App\Http\Controllers\ContasPagarController;

/* --------------------------------------------------------------------------
        Web Routes
   -------------------------------------------------------------------------- */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');

// Rota de contingência, desenvolver pagina custumizada!
Route::fallback(function() {
    return view('fallback');
});

Route::get('/contato',  [ContatoController::class, 'index'])->name('contato');
Route::post('/contato', [ContatoController::class, 'send'])->name('contato');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Grupo de rotas de autenticação de usuário */
Auth::routes();

Route::get('/usuario',                  [UserController::class, 'show'])->name('usuario');
Route::get('/usuario/nome',             [UserController::class, 'nome'])->name('usuario.nome');
Route::get('/usuario/senha',            [UserController::class, 'senha'])->name('usuario.senha');
Route::post('/usuario/atualizar-nome',  [UserController::class, 'updateNome'])->name('usuario.update.nome');
Route::post('/usuario/atualizar-senha', [UserController::class, 'updateSenha'])->name('usuario.update.senha');

Route::get('/receitas',             [ReceitaController::class, 'index'])->name('receita');
Route::post('/receitas',            [ReceitaController::class, 'pesquisar'])->name('receita.pesquisar');
Route::get('/receitas/cadastrar',   [ReceitaController::class, 'create'])->name('receita.create');
Route::post('/receitas/salvar',     [ReceitaController::class, 'store'])->name('receita.store');
Route::post('/receitas/editar',     [ReceitaController::class, 'edit'])->name('receita.edit');
Route::post('/receitas/visualizar', [ReceitaController::class, 'show'])->name('receita.show');
Route::post('/receitas/atualizar',  [ReceitaController::class, 'update'])->name('receita.update');
Route::delete('/receitas/excluir',  [ReceitaController::class, 'destroy'])->name('receita.destroy');

Route::get('/despesas',             [DespesaController::class, 'index'])->name('despesa');
Route::post('/despesas',            [DespesaController::class, 'pesquisar'])->name('despesa.pesquisar');
Route::get('/despesas/cadastrar',   [DespesaController::class, 'create'])->name('despesa.create');
Route::post('/despesas/salvar',     [DespesaController::class, 'store'])->name('despesa.store');
Route::post('/despesas/editar',     [DespesaController::class, 'edit'])->name('despesa.edit');
Route::post('/despesas/visualizar', [DespesaController::class, 'show'])->name('despesa.show');
Route::post('/despesas/atualizar',  [DespesaController::class, 'update'])->name('despesa.update');
Route::delete('/despesas/excluir',  [DespesaController::class, 'destroy'])->name('despesa.destroy');


Route::get('/aplicacoes',             [AplicacaoController::class, 'index'])->name('aplicacao');
Route::get('/aplicacoes/cadastrar',   [AplicacaoController::class, 'create'])->name('aplicacao.create');
Route::post('/aplicacoes/salvar',     [AplicacaoController::class, 'store'])->name('aplicacao.store');
Route::post('/aplicacoes/editar',     [AplicacaoController::class, 'edit'])->name('aplicacao.edit');
Route::post('/aplicacoes/visualizar', [AplicacaoController::class, 'show'])->name('aplicacao.show');
Route::post('/aplicacoes/atualizar',  [AplicacaoController::class, 'update'])->name('aplicacao.update');
Route::delete('/aplicacoes/excluir',  [AplicacaoController::class, 'destroy'])->name('aplicacao.destroy');
Route::post('/aplicacoes/movimentar', [AplicacaoController::class, 'movimentar'])->name('aplicacao.movimentar');

Route::get('/contas',             [ContaController::class, 'index'])->name('conta');
Route::get('/contas/cadastrar',   [ContaController::class, 'create'])->name('conta.create');
Route::post('/contas/salvar',     [ContaController::class, 'store'])->name('conta.store');
Route::post('/contas/editar',     [ContaController::class, 'edit'])->name('conta.edit');
Route::post('/contas/visualizar', [ContaController::class, 'show'])->name('conta.show');
Route::post('/contas/atualizar',  [ContaController::class, 'update'])->name('conta.update');
Route::delete('/contas/excluir',  [ContaController::class, 'destroy'])->name('conta.destroy');

/* Funcionalidade desativada
Route::get('/cartao-de-credito',             [CartaoCreditoController::class, 'index'])->name('cartaocredito');
Route::get('/cartao-de-credito/cadastrar',   [CartaoCreditoController::class, 'create'])->name('cartaocredito.create');
Route::post('/cartao-de-credito/salvar',     [CartaoCreditoController::class, 'store'])->name('cartaocredito.store');
Route::post('/cartao-de-credito/editar',     [CartaoCreditoController::class, 'edit'])->name('cartaocredito.edit');
Route::post('/cartao-de-credito/visualizar', [CartaoCreditoController::class, 'show'])->name('cartaocredito.show');
Route::post('/cartao-de-credito/atualizar',  [CartaoCreditoController::class, 'update'])->name('cartaocredito.update');
Route::delete('/cartao-de-credito/excluir',  [CartaoCreditoController::class, 'destroy'])->name('cartaocredito.destroy');
*/

Route::get('/contas-a-pagar',            [ContasPagarController::class, 'index'])->name('contas.pagar');
Route::post('/contas-a-pagar',           [ContasPagarController::class, 'pesquisar'])->name('contas.pagar.pesquisar');
Route::post('/contas-a-pagar/pagamento', [ContasPagarController::class, 'pagamento'])->name('contas.pagar.pagamento');
Route::post('/contas-a-pagar/cancelar',  [ContasPagarController::class, 'cancelar'])->name('contas.pagar.cancelar');

Route::get('/resumo-mensal', [ResumoMensalController::class,  'index'])->name('resumo.mensal');
Route::post('/resumo-mensal', [ResumoMensalController::class, 'pesquisar'])->name('resumo.mensal.pesquisar');