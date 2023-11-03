<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class BibliotecaController extends Action{

    public function biblioteca(){
       
        session_start();
        if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
            //o usuario esta autenticado e poderá acessar os recursos. 
            $this->render('biblioteca'); // chamo o metodo render() passando qual é a view que devera carregar.
        }
        
        else{
            // caso o acesso venha sem um user autenticado, direciono para o index.
            header('Location: /', '', 302);
        }
    }

    public function listaArquivos(){
        $arquivos = Container::getModel("Arquivos");

        $retornoArquivo = $arquivos->listarArquivos();
        echo $retornoArquivo;
        exit;
       if($retornoArquivo['status'] == 200){
            echo $retornoArquivo['msg'];
       }
        
    }

   
}

?>