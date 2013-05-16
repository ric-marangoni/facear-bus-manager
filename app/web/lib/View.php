<?php

class View {

	private $module;
	private $css;
	private $js;
	private $title;

	public function load() {
		
		$num_args = func_num_args();
		
		$path = VIEWDIR . $this->module . func_get_arg(0);
		
		$ajax = false;
		
		if($num_args == 2 && func_get_arg(1) == true) {
			$ajax = true;
		}
		
		if(!$ajax) {
			$this->getHeader();
		}
		
		require $path;
		
		if(!$ajax) {
			$this->getFooter();
		}
		
	}
	
	private function getHeader() {		
		require BASEDIR . 'app/layout/header.php';
	}
	
	private function getFooter() {
		require BASEDIR . 'app/layout/footer.php';
	}
	
	public function __set($var, $value) {
		$this->$var = $value;
	}
	
	public function __get($var) {
		return $this->$var;
	}

}