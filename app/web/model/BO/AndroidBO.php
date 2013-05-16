<?php

class AndroidBO {
    
    private $dao;
    
    public function getPeriodoSolicitacao() {
        return $this->dao->getPeriodoSolicitacao();
    }
    
    public function __construct() {
        $this->dao = new AndroidDAO();
    }
}


