<?php

namespace App;

class Connection {

	public static $conn;
	
	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=mysql;dbname=gerenciamento_pessoal",
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