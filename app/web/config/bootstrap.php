<?php

require 'settings.php';

$key = isset($_GET['key']) ? $_GET['key'] : '';

$url = explode('/', $key);
$controller_class = !empty($url[0]) ? ucwords($url[0]) : 'Index';

define('MODULE', $controller_class);

$controller_class .= 'Controller';

$action = !empty($url[1]) ? $url[1] : 'index';

$controller = new $controller_class();

if(count($url) > 2) {
    for($i = 2; $i < count($url); $i+=2) {
       
        $key = $url[$i];
        
        $_GET[$key] = $url[$i+1];
    }
}

$session = new Session();
$controller->view = new View();
$controller->request = new Request();

$controller->session = $session;
$controller->view->session = $session;

$controller->view->module = strtolower(MODULE).'/';
$controller->module = strtolower(MODULE).'/';

$controller->$action();