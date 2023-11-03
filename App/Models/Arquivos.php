<?php

namespace App\Models;
use MF\Model\Model;
use Exception;
use PDO;

class Arquivos extends Model{

    public function __get($atributo){
        return $this->$atributo;

    }

    public function __set($atributo, $valor){
        // atributo: qual é o que deverá ser alterado
        // valor: o novo valor do atributo (comentarios obvios...)
        $this->$atributo = $valor;

    }

    public function listarArquivos(){
        session_start();
        //print_r($_SESSION);

        $query = "SELECT * FROM tb_arquivos WHERE status = 1";
        $stmt = $this->db->prepare($query);

        try {
            
            $stmt->execute();
            
            // $conteudo = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            $conteudo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $retornoConsulta['status'] = '204';
            $retornoConsulta['msg'] = "Não há conteudo cadastrado";

            if(count($conteudo) > 0){

                $retornoConsulta['status'] = '200';
                $retornoConsulta['msg'] = $conteudo;

            }
            
        }
        catch (Exception $e){

            $retornoConsulta['status'] = '400';
            $retornoConsulta['msg'] = 'O cadastro não pode ser realizado. Por favor, tente mais tarde';

        }
        
        return json_encode($retornoConsulta,true);
       
    }

}