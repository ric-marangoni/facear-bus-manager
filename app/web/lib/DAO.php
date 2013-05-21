<?php

class DAO {
	
	private $conn;
	
	protected function open() {
		
		$this->conn = new PDO(
			'mysql:host='. DB_HOST .';dbname='. DB_NAME .'',
			''. DB_USER .'',
			''. DB_PASS .''
		);
		
		$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
	}
	
	protected function close() {
		$this->conn = null;
	}
    
    public function __get($name) {
        return $this->$name;
    }
	
}