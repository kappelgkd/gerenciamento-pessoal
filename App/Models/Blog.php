<?php

namespace App\Models;
use MF\Model\Model;
use Exception;
use PDO;

class Blog extends Model{

    /*
    PRECISO DEFINIR AS VARIAVEIS QUE VÃO EXISTIR E SERÃO ENVIADAS PELA APLICAÇÃO

    private $id;
    private $tarefa;
    private $usuarioTarefa;
    private $status;
    private $dataTarefa;
    */

    // FUNÇÕES ABAIXO PARA RESGATAR E ATRIBUIR VALOR. PADRÃO PARA TODOS OS MODELS.
    public function __get($atributo){
        return $this->$atributo;

    }

    public function __set($atributo, $valor){
        // atributo: qual é o que deverá ser alterado
        // valor: o novo valor do atributo (comentarios obvios...)
        $this->$atributo = $valor;

    }

    // FUNÇÕES ESPECIFICAS DE CADA MODEL

    public function cadastrarTexto(){
        session_start();
        $query = "insert into tb_textos_blog(texto, titulo, usuario, status) VALUES (:texto, :titulo, :usuario, :status)";
        $stmt = $this->db->prepare($query);

        $stmt->bindValue('titulo', $this->__get('titulo'), \PDO::PARAM_STR);
        $stmt->bindValue('texto', $this->__get('texto'), \PDO::PARAM_STR);
        $stmt->bindValue('usuario', $_SESSION['id'], \PDO::PARAM_STR);
        $stmt->bindValue('status', '1', \PDO::PARAM_STR);
        

        try {

            $stmt->execute();
            $retornoConsulta['status'] = '200';
            $retornoConsulta['msg'] = 'Cadastro realizado com sucesso';

        }
        catch (Exception $e){

            $retornoConsulta['status'] = '400';
            $retornoConsulta['msg'] = 'O cadastro não pode ser realizado. Por favor, tente mais tarde';

        }
        
        //return $this; // vou retornar o objeto gerado na consulta SQL.
        return $retornoConsulta;
     
    }

    public function listarTexto(){
        
        $query = "SELECT conteudo.texto, conteudo.titulo FROM tb_textos_blog as conteudo INNER JOIN tb_usuario as user ON conteudo.usuario = user.id";
        $stmt = $this->db->prepare($query);;
        $stmt->bindValue(':conteudo.usuario',$this->__get('id'), \PDO::PARAM_STR);
       
        try {
            
            $stmt->execute();
            
            // $conteudo = $stmt->fetch(\PDO::FETCH_ASSOC);
            // echo "<pre>";
            // var_dump($conteudo);
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

        return json_encode($retornoConsulta);

    }

    

}