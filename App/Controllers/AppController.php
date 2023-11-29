<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action{

    public function dashboard(){
       
        session_start();
        if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
            //o usuario esta autenticado e poderá acessar os recursos. 
            $this->render('dashboard'); // chamo o metodo render() passando qual é a view que devera carregar.
        }
        
        else{
            // caso o acesso venha sem um user autenticado, direciono para o index.
            header('Location: /', '', 302);
        }
    }

    public function finalizarTarefa(){
       
        //print_r($_POST);
        $tarefa = Container::getModel('Tarefas');

        $tarefa->alterarTarefas($_POST);

    }

    public function listarTarefa(){
       
        //print_r($_POST);
       $data = array(
        'Teste'=>'22',
        'Teste2'=>'222'
       );
       
       echo json_encode($data, true);


    }

    public function cadastrarTexto(){
        
        $texto = Container::getModel('Blog');
        //$texto->cadastrarTexto($_POST['titulo'], $_POST['texto']);
        //$texto->__set('texto', $_POST['texto']);
        
        //$texto->cadastrarTexto();
        echo json_encode(($texto->cadastrarTexto($_POST['texto'], $_POST['titulo'])), true);
        // exit;
    }

    public function listarTexto(){
        session_start();
        // print_r($_SESSION);
        $textoCadastrados = Container::getModel('Blog');
        //$textoCadastrados->__set('id', $_SESSION['id']);
        
        $textoCadastrados->listarTexto();
        
        echo $textoCadastrados->listarTexto();
    
    }

    public function dashboardTexto(){
        $this->render('dashboard-cadastro');
    
    }

}

?>