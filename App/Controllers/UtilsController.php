<?php
namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class UtilsController extends Action{

    public function gerarProtocolo(){
        
        $protocolo = date("Ymds").rand(100000000, 9999999999);
        return $protocolo;
        
    }
}