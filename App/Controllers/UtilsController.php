<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use Exception;
use App\Controllers\VerificacaoController;

class UtilsController extends Action
{

    public function gerarProtocolo()
    {

        $protocolo = date("Ymds") . rand(100000000, 9999999999);
        return $protocolo;
    }

    public function pokemonShort()
    {
        
        $randomNumber = rand(0, 1000);
        $retorno = array();
       
        $authorization = "Authorization: Bearer 1234";
        // Inicializa a sessão cURL
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pokeapi.co/api/v2/pokemon/'.$randomNumber,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        // aqui faço uma checagem do retorno para validação 
        $pokemon= json_decode($response, true);
        $pokemonName = $pokemon['name'];
        $pokemonImage = $pokemon['sprites']['front_default'];

        $retorno['status'] = 200;
        $retorno['infos'] = array(
            'pokemon'=>$pokemonName,
            'imagem'=>$pokemonImage
        );
        
        header('Content-Type: application/json');
        http_response_code($retorno['status']);

        $response = json_encode($retorno, true);
        echo $response;

    }

    public function quoteRandom(){

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.quotable.io/random',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $dados = array();

        try{
            
            if($response == ""){
                throw new Exception('Sem conteúdo', 204);
            }

            //print_r($response);
            $retorno = json_decode($response);
            $content = $retorno->content;
            $author = $retorno->author;
            $mensageiro = new VerificacaoController;
            $dados['status'] = 200;
            $dados['conteudo'] = array(
                "content"=> $content,
                "author"=>$author,
                "mensagem"=> "<pre>".$content.'-'.$author."</pre>"
            );
            
            $mensageiro->configurarMensagemTelegram($dados);
            $gravaRetorno = Container::getModel("Utils");
            $gravaRetorno->setInfo($dados);

            // vou checar se o retorno abaixo tem erro e caso exista, vou salvar um arquivo e enviar uma notificacao. Vou usar bots separados. Um para aviso de erro e log e outro para recebimento de mensagens e utilidades.
            $gravaRetorno->salveBD($gravaRetorno->getInfo());
            
        }
        
        
        catch(Exception $e){
            $dados['status'] = $e->getCode();
            $dados['mensagem'] = $e->getMessage();
        }
        
        
        // http_response_code($dados['status']);
        // echo json_encode($dados);
        

    }

}
