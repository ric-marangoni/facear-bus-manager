<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Folga
 *
 * @author Ricardo
 */
class Folga {
    
    private $id;
    private $data;
    private $funcionario;
    
    public function __set($var, $value) {
        $this->$var = $value;
    }

    public function __get($var) {
        return $this->$var;
    }
    
}

?>
