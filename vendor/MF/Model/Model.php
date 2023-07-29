<?php


namespace MF\Model;

abstract class Model {

	protected $db;

	public function __construct($db) {
		/*
			POR ALGUMA RAZAO, AO DEFINIR O $db COMO (/PDO $db), é apresentado um erro.
			CONSEGUI SOLUCIONAR NÃO DEFININDO O TIPO DE VARIAVEL QUE RECEBO NA INSTANCIA DA CLASSE.
		*/

		$this->db = $db;
	}
}


?>