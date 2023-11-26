<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class AuthController extends Action{
    

    public function autenticar(){
        
        $usuario = Container::getModel('Usuario');
        $payload = json_decode(file_get_contents("php://input"));
        // print_r($payload);
        // exit;
        
        $usuario->__set('login', $payload->usuario);
        $usuario->__set('senha', $payload->senha);
        $usuario->autenticar();
        $retorno = array();

        // validando se as informações foram preenchidas para validar a autenticacao e realizar o direcionamento.
        if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){
            
            
            // iniciando e atribuindo sessoes. Desta forma, sempre que for utilizar sessao, deverá inicia-la.
            session_start();
            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');
            
            $token = $this->gerarTokenAutenticacao($_SESSION['id']);
           
            $retorno=array(
                "status" => "200",
                "redirecionar"=>"dashboard",
                "mensagem"=>"Login efetuado",
                "token"=>$token

            );

            //header('Location: /dashboard', '200');
        }
        else{
           //header('Location: /?login=erro', '400');
            $retorno = array(
                "status" => "404",
                "mensagem"=>"Erro ao efetuar login"
            );
        }
        
        echo json_encode($retorno,true);
    }

    // metodo privado pois a principio só deve ser chamado dentro da classe 
    private function gerarTokenAutenticacao($idUsuario){
        $key = "1234";
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // Token válido por 1 hora
        //$key = "1234";

        $payload = array(
            'user_id' => $idUsuario,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        );

        // gerando token de autenticacao. obs.: criar um metodo para fazer essa operacao
        $token = JWT::encode($payload, $key, 'HS256');
        // $decoded = JWT::decode($token, new Key($key, 'HS256'));
        return $token;

    }

    public function validarToken($token){
        $key = "1234";
        try{
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return $decoded;
        }
        catch(Exception $e){

        }
    }
    
}