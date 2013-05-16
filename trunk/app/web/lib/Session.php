<?php

class Session {
	
	public function setFlash($var, $value) {		
		$_SESSION['flash'][$var]['value'] = $value;
		$_SESSION['flash'][$var]['count'] = 0;
	}
	
	public function getFlash($var) {
		if(!isset($_SESSION['flash'][$var])) {
			return false;
		}
	
		if($_SESSION['flash'][$var]['count'] > 0) {
			unset($_SESSION['flash'][$var]);
			return false;
		}
		
		$_SESSION['flash'][$var]['count']++;
		
		return $_SESSION['flash'][$var]['value'];
	}
	
	public function __construct() {
		session_start();
	}
	
}