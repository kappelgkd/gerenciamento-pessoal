<?php

namespace App\Models;
use MF\Model\Model;
use Exception;
use PDO;

class Utils extends Model{
    private $data;
    public function getInfo(){
        return $this->data;

    }

    public function setInfo($info){
        // atributo: qual é o que deverá ser alterado
        // valor: o novo valor do atributo (comentarios obvios...)
        $this->data=$info;

    }

    public function salveBD($data){
        $status = $data['status'];
        $content = $data['conteudo']['mensagem'];
        
        $query = "INSERT INTO tb_log_quotes(mensagem, http_status) VALUES (:mensagem, :http_status)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue('mensagem', $content, \PDO::PARAM_STR);
        $stmt->bindValue('http_status', $status, \PDO::PARAM_STR);

        try{
            if(!$stmt->execute()){
                throw new Exception();
            }
        }
        catch(Exception $e){
            // vou retornar caso tenha erro na hora do inserir na base de dados. Desta forma, no controller eu vou salvar um log em um arquivo e enviar uma notificação.
            return $e->getMessage();
        }

    }

}