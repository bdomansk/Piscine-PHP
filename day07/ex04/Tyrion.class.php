<?php
class Tyrion extends Lannister{
	public function sleepWith($partner){
		if ($partner instanceof Sansa)
			print("Let's do this." . PHP_EOL);
		else
			print("Not even if I'm drunk !" . PHP_EOL);
	}
}
?>