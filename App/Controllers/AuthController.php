<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use \Firebase\JWT\JWT;

class AuthController extends Action{

    public function autenticar(){
        // echo 'aqui';
        
        $usuario = Container::getModel('Usuario');
        $key = "1234";

        $usuario->__set('login', $_POST['login']);
        $usuario->__set('senha', $_POST['senha']);
        $retorno = array();
        $usuario->autenticar();
        
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // Token válido por 1 hora

        // validando se as informações foram preenchidas para validar a autenticacao e realizar o direcionamento.
        if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){
            
            $payload = array(
                'user_id' => $usuario->__get('id'),
                'iat' => $issuedAt,
                'exp' => $expirationTime
            );

            $token = JWT::encode($payload, $key, 'HS256');
           
            // iniciando e atribuindo sessoes. Desta forma, sempre que for utilizar sessao, deverá inicia-la.
            session_start();
            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');
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
    
}