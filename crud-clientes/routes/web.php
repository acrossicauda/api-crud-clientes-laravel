<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\EnderecosController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

Route::get('/', function () {
    return view('welcome');
});

// USUARIOS
Route::prefix('usuarios')->group(function () {

    Route::get('/', [UsuariosController::class,'index']);
    // busca todos
    Route::get('show', function (Request $request, Response $response) {
        $user = new UsuariosController();
        $data = (!empty($request->all())) ? $request->all() : '';
        return $user->show($data);
    });
    // Cria um novo usuario
    Route::post('salvar', function (Request $request, Response $response) {
        $user = new UsuariosController();
        $resp = $user->store($request->all());
        return $resp;
    });
    // Atualiza um usario existente
    Route::post('editar', function (Request $request, Response $response) {
        $user = new UsuariosController();
        $resp = $user->update($request->all());
        return $resp;
    });
    // Exclui um usario existente
    Route::post('excluir', function (Request $request, Response $response) {
        $user = new UsuariosController();
        $resp = $user->destroy($request->id);
        return $resp;
    });
});

// ENDERECOS
Route::prefix('enderecos')->group(function () {

    Route::get('/', [EnderecosController::class,'index']);

    Route::get('/show', function (Request $request, Response $response) {
        $endereco = new EnderecosController();
        $data = (!empty($request->all())) ? $request->all() : '';
        return $endereco->show($data);
    });
    // Cria um novo usuario
    Route::post('salvar', function (Request $request, Response $response) {
        $endereco = new EnderecosController();
        $resp = $endereco->store($request->all());
        return $resp;
    });
    // Atualiza um usario existente
    Route::post('/editar', function (Request $request, Response $response) {
        $endereco = new EnderecosController();
        $resp = $endereco->update($request->all());
        return $resp;
    });
    // Exclui um usario existente
    Route::post('excluir', function (Request $request, Response $response) {
        $endereco = new EnderecosController();
        $resp = $endereco->destroy($request->id);
        return $resp;
    });
});

