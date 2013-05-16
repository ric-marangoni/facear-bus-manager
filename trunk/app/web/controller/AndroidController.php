<?php

class AndroidController extends Controller {
    
    private $bo;
	
	public function getPeriodoSolicitacao() {
		echo $this->bo->getPeriodoSolicitacao();
	}
	
	public function __construct() {
        $this->bo = new AndroidBO();
    }
	
}