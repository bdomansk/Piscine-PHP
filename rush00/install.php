<?php
	
if (!file_exists('db/cart')){
	file_put_contents('db/cart.csv', "");
}
header("Location: /index.php")

?>