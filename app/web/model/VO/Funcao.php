<?php

class Funcao {
	
	private $id;
	private $descricao;
	
	public function __set($var, $value) {
		$this->$var = $value;
	}
	
	public function __get($var) {
		return $this->$var;
	}
	
}