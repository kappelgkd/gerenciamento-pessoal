<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action{

    public function autenticar(){
        // echo 'aqui';
        // print_r($_POST);

        $usuario = Container::getModel('Usuario');

        $usuario->__set('login', $_POST['login']);
        $usuario->__set('senha', $_POST['senha']);
    
        $usuario->autenticar();
        
        // validando se as informações foram preenchidas para validar a autenticacao e realizar o direcionamento.
        if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){
            // echo 'autenticar';

            // iniciando e atribuindo sessoes. Desta forma, sempre que for utilizar sessao, deverá inicia-la.
            session_start();
            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');

            header('Location: /dashboard', '200');
        }
        else{
           header('Location: /?login=erro', '400');
        }

    }

}