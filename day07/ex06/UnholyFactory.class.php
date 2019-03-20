<?php
class UnholyFactory{
	private $all_fightres = array();
	public function absorb($fighter){
		if ($fighter instanceof Fighter){
			if (in_array($fighter, $this->all_fightres))
			{
				print("(Factory already absorbed a fighter of type ". $fighter->getFighter(). ")" .PHP_EOL);
			}
			else{
				$this->all_fightres[$fighter->getFighter()] = $fighter;
				print("(Factory absorbed a fighter of type ". $fighter->getFighter(). ")" .PHP_EOL);
			}
		}
		else{
			print("(Factory can't absorb this, it's not a fighter)". PHP_EOL);
		}
	}
	public function fabricate($fighter_name){
		if (array_key_exists($fighter_name, $this->all_fightres)){
			print("(Factory fabricates a fighter of type ". $fighter_name. ")" .PHP_EOL);
			return ($this->all_fightres[$fighter_name]);
		}
		else{
			print("(Factory hasn't absorbed any fighter of type ". $fighter_name. ")" .PHP_EOL);
		}
	}
}
?>