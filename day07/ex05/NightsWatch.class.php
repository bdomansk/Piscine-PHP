<?php
class NightsWatch{
	public $all;
	public function recruit($new){
		if ($new instanceof IFighter){
			$this->all[] = $new; 
		}
	}
	public function fight(){
		foreach($this->all as $element){
			$element->fight();
		}
	}
}
?>