<?php

function __autoload($class){
	if(file_exists(BASEDIR . "controller/$class.php")){
		require BASEDIR . "controller/$class.php";
	}
	
	if(file_exists(BASEDIR . "lib/$class.php")){
		require BASEDIR . "lib/$class.php";
	}
	
	if(file_exists(BASEDIR . "model/VO/$class.php")){
		require BASEDIR . "model/VO/$class.php";
	}
	
	if(file_exists(BASEDIR . "model/DAO/$class.php")){
		require BASEDIR . "model/DAO/$class.php";
	}
    
    if(file_exists(BASEDIR . "model/BO/$class.php")){
		require BASEDIR . "model/BO/$class.php";
	}
}