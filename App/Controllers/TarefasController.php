<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class TarefasController extends Action{

    public function tarefas(){
        // metodo principal que vai renderizar a view.
        session_start();
        if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
            //o usuario esta autenticado e poderá acessar os recursos. 
            $this->render('tarefas'); // chamo o metodo render() passando qual é a view que devera carregar.
        }
        
        else{
            // caso o acesso venha sem um user autenticado, direciono para o index.
            header('Location: /', '', 302);
        }
    }

    public function cadastrarTarefa(){
        session_start();
        
        echo '<pre>';
        print_r($_POST);
        
    }
   
}

?>