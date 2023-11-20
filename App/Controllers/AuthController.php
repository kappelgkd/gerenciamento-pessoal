<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action{

    public function autenticar(){
        // echo 'aqui';
        
        $usuario = Container::getModel('Usuario');

        $usuario->__set('login', $_POST['login']);
        $usuario->__set('senha', $_POST['senha']);
        $token = bin2hex(random_bytes(32));
        $retorno = array();
        $usuario->autenticar();
        
        // validando se as informações foram preenchidas para validar a autenticacao e realizar o direcionamento.
        if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){
           
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