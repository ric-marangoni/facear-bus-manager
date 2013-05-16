<?php

class Funcionario {

    private $id;
    private $nome;
    private $Funcao;
    private $hora_ini;
    private $hora_fim;

    public function __set($var, $value) {
        $this->$var = $value;
    }

    public function __get($var) {
        return $this->$var;
    }

}