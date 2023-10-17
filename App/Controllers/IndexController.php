<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->view->login=isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');

	}

	public function dashboard() {

		$this->render('dashboard');
	}

	public function inscreverse() {
	
		$this->render('inscreverse');
	
	}

	public function registrar() {

		/*
			NESSE METODO VAMOS RECEBER OS DADOS DO FORMULÁRIO DE REGISTRO DE USUÁRIOS
			E VAI PASSAR AS INFORMAÇÕES PARA O MODEL DE USUÁRIOS.

		*/
		
		// INSTANCIANDO A CLASSE DO MODEL QUE SERÁ UTILIZADA.
		$usuario = Container::getModel('Usuario');

		// TRATANDO OS DADOS PARA ENTÃO PASSAR PARA O MODEL.
		// print_r($_POST);
		// exit;
		$usuario->__set('login', $_POST['login']);
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);
		$usuario->salvar(); // MÉTODO DO MODEL USUARIOS PARA MANIPULAR AS INFORMAÇÕES NA BASE DE DADOS.
		
		// $this->render('registrar');
	
	}

}


?>