<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('/', \App\Http\Controllers\Portal\PortalController::class);

Route::post('/consulta/cep', [\App\Http\Controllers\Portal\PortalController::class,'consultaCep']);

Route::group(['prefix' => '/mscurso', 'as' => 'mscurso.', 'middleware' => ['auth:sanctum', 'verified']], function () {

    //DASHBOARD
    Route::resource('/dashboard', \App\Http\Controllers\Home\HomeController::class);

    Route::resource('/usuario', \App\Http\Controllers\Usuario\UsuarioController::class);
    Route::get('/listar/inscritos', [\App\Http\Controllers\Curso\CursoController::class,'listarInscritos'])->name('curso.listar.inscritos');
    Route::resource('/cursos', \App\Http\Controllers\Curso\CursoController::class);
    Route::resource('/aluno', \App\Http\Controllers\Aluno\AlunoController::class);
    Route::resource('/permissao', \App\Http\Controllers\Permissao\PermissaoController::class);
    Route::delete('/delete/curso', [\App\Http\Controllers\Curso\CursoController::class,'delete'])->name('delete.curso');
    Route::get('/carrinho/adiciona/{id}', [\App\Http\Controllers\Carrinho\CarrinhoController::class,'adiciona'])->name('adiciona.curso');
    Route::get('/carrinho', [\App\Http\Controllers\Carrinho\CarrinhoController::class,'carrinho'])->name('carrinho.curso');
    //Route::resource('/carrinho', \App\Http\Controllers\Carrinho\CarrinhoController::class);
    Route::get('/redirect/pagueSeguro', [\App\Http\Controllers\Curso\CursoController::class,'redirectPagueSeguro'])->name('pagueseguro');

    Route::resource('/anexos', \App\Http\Controllers\Anexo\AnexoController::class);
    Route::get('/download/{id}', [\App\Http\Controllers\Anexo\AnexoController::class,'download'])->name('donwload.anexo');
    Route::delete('/delete/anexo', [\App\Http\Controllers\Anexo\AnexoController::class,'delete'])->name('delete.anexo');

    //Route::middleware(['permission:consolida'])->get('/fechamento/LancarFechamentoPoupanca/{id}', [App\Http\Controllers\Consolidacao\ConsolidacaoFechamentoCreateController::class,'fechamento'])->name('cosolidacao.fechamento.create');

    Route::get('/pagseguro', [\App\Http\Controllers\Pagueseguro\PageSeguroController::class,'pagseguro'])->name('pagseguro');
    Route::get('/pague-seguro', [\App\Http\Controllers\Pagueseguro\PageSeguroController::class,'lightBox'])->name('pagueseguro.lightbox');
    Route::post('/pague-seguro', [\App\Http\Controllers\Pagueseguro\PageSeguroController::class,'lightBoxCode'])->name('pagueseguro.lightbox.code');

    Route::post('/pagseguro-transparente', [\App\Http\Controllers\Pagueseguro\PageSeguroController::class,'getCode'])->name('pagseguro.code.transparente');
    Route::get('/pagseguro-transparente', [\App\Http\Controllers\Pagueseguro\PageSeguroController::class,'transparente'])->name('pagseguro.transparente');

    Route::post('/pagseguro-billet', [\App\Http\Controllers\Pagueseguro\PageSeguroController::class,'billet'])->name('pagseguro.billet');

    Route::get('/comprar-cursos', [\App\Http\Controllers\Portal\PortalController::class, 'index'])->name('comprar.mcurso');

    Route::get('/finalizar-pedido', [\App\Http\Controllers\Pagamento\PagamentoController::class,'index'])->name('pagamento.index');

    Route::get('/meus-pedidos', [\App\Http\Controllers\Pedido\PedidoController::class,'index'])->name('pedido.index');
});


require __DIR__.'/auth.php';
