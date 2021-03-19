<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
//use App\Http\Controllers\UsuariosController;
//use App\Http\Controllers\EnderecosController;
use Illuminate\Http\Request;

class CadastrosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = new UsuariosController();
        $endereco = new EnderecosController();
        $user->index();
        $endereco->index();
        echo  '<br>' . __CLASS__ . '<br>';
    }

    public function validaRequest() {
        $success = true;
        $msgErro = false;
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            //header('HTTP/1.0 400 Bad Request');
            header('HTTP/1.0 401 Unauthorized');
            $msgErro = 'Token not found in request';
            $success = false;
        }
        return ['success' => $success, 'message' => $msgErro];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        echo __FUNCTION__;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show($name) {
        echo $name;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function create($request) {
        return $this->teste(__FUNCTION__, $request->all());
        //echo $response->json($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update($request) {
        return $this->teste(__FUNCTION__, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($request) {
        return $this->teste(__FUNCTION__, $request->all());
    }

    public function teste($event, $params) {
        $dados = array();
        if($event == 'create') {
            $dados = [
                'success' => true,
                'message' => 'Cadastro criado',
                'status' => 201,
                'id' => 1,
                'data' => $params
            ];
            if(empty($params)) {
                $dados['success'] = false;
                $dados['message'] = 'Parametros invalidos';
                $dados['status'] = 200;
                unset($dados['id']);
            }
            header('HTTP/1.0 401 Unauthorized');
        } else if($event == 'update') {
            $dados = [
                'success' => true,
                'message' => 'Cadastro atualizado',
                'status' => 201,
                'id' => 1,
                'data' => $params
            ];
            if(empty($params)) {
                $dados['success'] = false;
                $dados['message'] = 'Parametros invalidos';
                $dados['status'] = 200;
                unset($dados['id']);
            }
            header('HTTP/1.0 401 Unauthorized');
        } else if($event == 'destroy') {
            $dados = [
                'success' => true,
                'message' => 'Cadastro Excluido',
                'status' => 201,
                'id' => 1,
                'data' => $params
            ];
            if(empty($params)) {
                $dados['success'] = false;
                $dados['message'] = 'Parametros invalidos';
                $dados['status'] = 200;
                unset($dados['id']);
            }
            header('HTTP/1.0 401 Unauthorized');
        }
        return $dados;
    }
}
