<?php
namespace App\Controllers;
require '../vendor/autoload.php';

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use Monolog\Logger;
use Monolog\Handler\TelegramBotHandler;
use MnoLog\Handler\StreamHandler;
use Monolog\Handler\StreamHandler as HandlerStreamHandler;

class VerificacaoController extends Action{
    
    public $mensagem;

    public function getMensagemLog(){
        return $this->mensagem;
    }
    public function setMensagemLog($mensagem){
        $this->mensagem = $mensagem;
    }

    public function enviarNotificacaoErroTelegram(){
        // esse metodo eu utilizo a lib monolog para enviar mensagem
        $localHost = "localhost:2000";
        $httpHost = $_SERVER['HTTP_HOST'];
        
        if($localHost != $httpHost){
            return;
        }
        
        $log = new Logger("log_app");
        $botTelegram = new TelegramBotHandler(
           $_ENV['TELEGRAM_TOKEN'],
           $_ENV['TELEGRAM_CHAT_ID']
        );
        
        // abaixo para gravar num arquivo no servidor
        //$log->pushHandler(new HandlerStreamHandler('../log.txt'));
        //$log->warning('Esta é uma mensagem de aviso');
        
        // para envio de mensagem via telegram
        $log->pushHandler($botTelegram);
        $log->error('Isso é um erro! Uma notificação será enviada para o bot do Telegram.');

    }

    public function configurarMensagemTelegram(array $conteudo){
        
        //print_r($conteudo);
        try{
           
            if($conteudo['status'] != 200){
                throw new Exception('Sem conteúdo', 204);
            }
            
            $mensagem = $conteudo['conteudo']['mensagem'];

            VerificacaoController::enviarMensagemTelegram($mensagem);
        }
        catch(Exception $e){

        }
        
    }

    public function enviarMensagemTelegram($mensagem){
        $tokenBot = $_ENV['TELEGRAM_TOKEN'];
        $tokenID = $_ENV['TELEGRAM_CHAT_ID'];
        
        $apiUrl = "https://api.telegram.org/bot{$tokenBot}/sendMessage";

        $params = [
            'chat_id' => $tokenID,
            'text' => $mensagem,
            'parse_mode' => 'HTML',
        ];

        // Inicializa a sessão cURL
        $ch = curl_init($apiUrl);
        // Configura as opções do cURL
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        
        curl_close($ch);
        return true;
        //echo $response;

    }

    public function salvarLogAcesso(){

    }

    public function salvarLogErro(){

    }

    public function salvarLogConexaoBD(){

    }
   
}

?>