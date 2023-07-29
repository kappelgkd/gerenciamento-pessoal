<?php

namespace App\Models;
use MF\Model\Model;
use Exception;

class Tarefas extends Model{

    private $id;
    private $tarefa;
    private $usuarioTarefa;
    private $status;
    private $dataTarefa;

    // FUNÇÕES ABAIXO PARA RESGATAR E ATRIBUIR VALOR
    public function __get($atributo){
        return $this->$atributo;

    }

    public function __set($atributo, $valor){
        // atributo: qual é o que deverá ser alterado
        // valor: o novo valor do atributo (comentarios obvios...)
        $this->$atributo = $valor;

    }

    public function listarTarefas(){

    }

    public function cadastrarTarefas(){
        
    }

    public function alterarTarefas(array $tarefa){
        
        print_r($tarefa);
        
    }

}