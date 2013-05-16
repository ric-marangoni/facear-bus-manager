<?php

abstract class Controller {

    public function redirect($view) {
        header('Location: ' . $module . $view);
    }

    public function __set($var, $value) {
        $this->$var = $value;
    }

    public function __get($var) {
        return $this->$var;
    }

}