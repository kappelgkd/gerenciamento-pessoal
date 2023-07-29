<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		// ROTAS PUBLICAS. PODEM SER ACESSADAS PELO USUARIO ANTES DE REALIZAR O LOGIN.
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		// ROTA PARA A ROTINA DE AUTENTICAÇÃO
		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		// ROTAS PRIVADAS. SÃO ACESSADAS APÓS O USUARIO REALIZAR O LOGIN.
		$routes['dashboard'] = array(
			'route' => '/dashboard',
			'controller' => 'AppController',
			'action' => 'dashboard'
		);

		$routes['finalizarTarefa'] = array(
			'route' => '/finalizar-tarefa',
			'controller' => 'AppController',
			'action' => 'finalizarTarefa'
		);

		$routes['listarTarefa'] = array(
			'route' => '/listar-tarefa',
			'controller' => 'AppController',
			'action' => 'listarTarefa'
		);

		$this->setRoutes($routes);
	}

}

?>