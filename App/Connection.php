<?php

namespace App;

class Connection {

	public static $conn;
	
	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=192.168.0.3;dbname=gerenciamento_pessoal_hmg",
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