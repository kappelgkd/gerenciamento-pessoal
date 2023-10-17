<?php

/*

    ESSA CLASSE VAI SER A RESPONSAVEL PARA MANIPULAR OS DADOS
    DA TABELA DE USUARIOS.

    A PRINCIPIO, A TABELA SÓ EXIGE CADASTRO DE NOME, LOGIN, SENHA E E-MAIL
    MAS PODERÁ SER ATUALIZADA NO FUTURO.


*/

namespace App\Models;
use MF\Model\Model;
use Exception;


class Usuario extends Model{

    private $id;
    private $login;
    private $nome;
    private $email;
    private $senha;

    public function __get($atributo){
        return $this->$atributo;

    }

    public function __set($atributo, $valor){
        // atributo: qual é o que deverá ser alterado
        // valor: o novo valor do atributo (comentarios obvios...)
        $this->$atributo = $valor;

    }

    // salvar usuários na base de dados.
    public function salvar(){
        
        // é importante sanitizar os dados antes de enviar a base de dados.
        $query = "insert into tb_usuario(login, nome, email, senha)values(:login, :nome, :email, :senha)";
        $stmt = $this->db->prepare($query);
       
        $stmt->bindValue('login', $this->__get('login'), \PDO::PARAM_STR);
        $stmt->bindValue('nome', $this->__get('nome'), \PDO::PARAM_STR);
        $stmt->bindValue('email', $this->__get('email'), \PDO::PARAM_STR);
        $stmt->bindValue('senha', $this->__get('senha'), \PDO::PARAM_STR); // vai utilizar o metodo md5
    
        try {

            $stmt->execute();
            $retornoConsulta['status'] = '200';
            $retornoConsulta['msg'] = 'Cadastro realizado com sucesso';

        }
        catch (Exception $e){

            $retornoConsulta['status'] = '400';
            $retornoConsulta['msg'] = 'O cadastro não pode ser realizado. Por favor, tente mais tarde';

        }
        
        return $this; // vou retornar o objeto gerado na consulta SQL.
        // return $retornoConsulta;
        
    }

    public function autenticar(){

        $query = "SELECT id, login, nome, email, senha FROM tb_usuario WHERE login = :login AND senha = :senha";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindValue('login', $this->__get('login'), \PDO::PARAM_STR);
        $stmt->bindValue('senha', $this->__get('senha'), \PDO::PARAM_STR);

        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($usuario['id'] != '' && $usuario['nome'] != ''){
           
            // atribuindo valores do objeto com o retorno do banco para poder acessa-los futuramente
            $this->__set('id', $usuario['id']);
            $this->__set('nome', $usuario['nome']);

        }

        return $this;

    }

   

}

?>