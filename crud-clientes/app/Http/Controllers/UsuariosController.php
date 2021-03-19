<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Exception;
use App\Http\Controllers\EnderecosController;
use DB;
use Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        echo  '<br>' . __CLASS__ . '<br>';
    }

    /**
     * irá fazer a validação do endereço, separar os daods de cidades, estados e endereços
     * @param array $dados
     * return $idEndereco
     */
    private function cadastrarEndereco($dados = array()) {
        $resp = array();
        $endereco = new EnderecosController();
        if(empty($dados)) {
            $resp = ['success' => false, 'message' => 'Parâmetros incorretos, necessario informar o id do endereço ou os dados que serão cadastrados para esse usuário'];
        } else if(isset($dados['idEndereco']) && !empty(isset($dados['idEndereco']))){
            $filtros = array('campos' => 'enderecos', 'id' => $dados['idEndereco']);
            $resp = $endereco->show($filtros);
            $resp = ['success' => true, 'idEndereco' => $resp['data'][0]->id];
        } else {
            $resp = $endereco->store($dados);
        }

        return $resp;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($dadosUsuarios) {
        //return $dadosUsuarios;
        $sucesso = true;
        $message = '';

        $resp = $this->cadastrarEndereco($dadosUsuarios);
        if($resp['success']) {
            $idEndereco = $resp['idEndereco'];
            $dadosUsuarios['idEndereco'] = $idEndereco;
            $camposObrigatorios = array(
                'nome', 'login', 'senha', 'idEndereco'
            );
            foreach ($camposObrigatorios as $k => $value) {
                if(!isset($dadosUsuarios[$value]) || empty($dadosUsuarios[$value])) {
                    $sucesso = false;
                    $message .= "o campo '{$value}' não pode ser vazio\n";
                }

            }
        } else {
            $sucesso = false;
            $message = $resp['message'];
        }
        $idUsuario = '';
        if($sucesso) {

            $nome = $dadosUsuarios['nome'];
            $login = $dadosUsuarios['login'];
            //$senha = bcrypt($dadosUsuarios['senha']);
            $senha = Hash::make($dadosUsuarios['senha']);
            $idEndereco = $dadosUsuarios['idEndereco'];

            try {
                $idUsuario = DB::table('usuarios')->insertGetId(
                    array(
                        'name' => $nome,
                        'login' => $login,
                        'senha' => $senha,
                        'idEndereco' => $idEndereco,
                        'created_at' => date('Y-m-d'),
                    )
                );
                if($idUsuario) {
                    $message = 'Usuario cadastrado';
                } else {
                    $sucesso = false;
                    $message = 'Erro ao tentar cadastrar um Usuário';
                }
            } catch(Exception $e) {
                return "Erro: " . $e->getMessage();
            }

        }

        return ['success' => $sucesso, 'message' => $message, 'idUsuario' => $idUsuario];
    }

    public static function validaUser($login, $senha) {
        $ok = false;
        $senha = Hash::make($senha);
        $query = "SELECT name, senha FROM usuarios WHERE login = $login";
        $data = DB::select($query);
        $ok = Hash::check($senha, $data['senha']) ? true : false;
        return $ok;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($campos = array()) {

        // Irá montar um where com os campos que vierem nesse array
        // então essa var vai servir para que não venha campos desnecessarios
        $validaCampos = array('id', 'name', 'login', 'created_id', 'updated_id');
        $query = "SELECT id, name, login, created_at, updated_at, idEndereco FROM usuarios";
        if(!empty($campos)) {
            $where = array();
            foreach ($campos as $key => $value) {
                if(in_array($key, $validaCampos)) {
                    $where[] = " {$key} = '$value' ";
                }
            }
            if(!empty($where)) {
                $query .= " WHERE ";
                $query .= implode(' AND ', $where);
            }
        }

        $resp = DB::select($query);
        $endereco = new EnderecosController();

        foreach ($resp as $k => $value) {
            if(!empty($value->idEndereco)) {
                $data = $endereco->show(['id' => $value->idEndereco]);
                $resp[$k]->endereco[] = $data['data'];
            }
        }


        return ['data' => $resp];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($campos) {
        // Irá montar um where com os campos que vierem nesse array
        // então essa var vai servir para que não venha campos desnecessarios
        $validaCampos = array('name', 'login', 'senha');
        $message = '';
        if(isset($campos['id']) && !empty($campos['id'])) {

            $idUsuario = $campos['id'];

            $query = "UPDATE usuarios set ";

            if(!empty($campos)) {
                $updateSet[] = "updated_at = '" . date('Y-m-d') . "'";
                foreach ($campos as $key => $value) {
                    if(in_array($key, $validaCampos)) {
                        if($key == 'senha') {
                            $value = Hash::make($value);
                        }
                        $updateSet[] = " {$key} = '$value' ";
                    }
                }
                if(!empty($updateSet)) {
                    $query .= implode(', ', $updateSet);
                }
            }

            $query .= " WHERE id = $idUsuario";

            $resp = DB::update($query);
            if($resp) {
                $resp = true;
                $message = 'Usuario Atualizado';
            } else {
                $resp = false;
                $message = 'Erro ao tentar atualizar Usuario';
            }

        } else {
            $resp = false;
            $message = "O campo 'id' é obrigatório";
        }

        return ['success' => $resp, 'message' => $message];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUsuario) {
        $ok = false;
        $message = '';
        if(!empty($idUsuario)) {
            $ok = DB::delete("DELETE FROM usuarios where id = $idUsuario");
            if($ok) {
                $message = 'Usuario Excluído';
            } else {
                $message = 'Ocorreu um erro na tentativa de excluir o usuario ' . $idUsuario;
            }
        } else {
            $message = "O campo 'id' não pode ser vazio";
        }
        //DB::beginTransaction();
        //DB::commit();
        //DB::rollback();
        return ['success' => $ok, 'message' => $message];
    }
}
