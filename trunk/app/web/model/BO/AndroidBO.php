<?php

class AndroidBO {
    
    private $dao;
    
    public function getPeriodoSolicitacao() {
        return $this->dao->getPeriodoSolicitacao();
    }
    
    public function getComboLinhas() {
        return $this->dao->getComboLinhas();        
    }
    
    public function __construct() {
        $this->dao = new AndroidDAO();
    }
}


