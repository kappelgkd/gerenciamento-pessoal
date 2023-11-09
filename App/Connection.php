<?php

namespace App;

class Connection {

	public static $conn;
	
	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=192.168.0.7;dbname=gerenciamento_pessoal",
				"root",
				"1234" 
			);
			
			return $conn;

		} catch (\PDOException $e) {
			throw new \PDOException($e);
		}
	}

	}

?>