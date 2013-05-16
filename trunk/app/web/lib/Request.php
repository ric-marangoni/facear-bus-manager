<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author Ricardo
 */
class Request {
    
    private $post;
    private $get;
    
    public function __construct() {
        
        $this->post = new Post();
        $this->get = new Get();
        
        foreach ($_POST as $key => $value){
            $this->post->$key = $value;
        }
        
        foreach ($_GET as $key => $value){
            $this->get->$key = $value;
        }
        
    }
    
    public function __get($var) {
        return $this->$var;
    }
    
}
