<?php
class Fighter{
	public $fighter_name;
	public function __construct($name) {
		$this->fighter_name = $name;
	}
	public function getFighter(){
		return $this->fighter_name;
	}
}
?>