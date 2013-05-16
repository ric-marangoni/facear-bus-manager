<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GraficoController
 *
 * @author Ricardo
 */
class GraficoController {
    
    public function show() {
        
        $funcaoDAO = new FuncaoDAO();
        
        $this->view->funcoes = $funcaoDAO->getAll();
        
        $this->view->load('show.php');
        
    }
    
}

?>
