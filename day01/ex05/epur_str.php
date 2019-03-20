#!/usr/bin/php
<?php
function erup($str)
{
	$str = trim($str);
	$new = preg_replace("/[ ]+/", ' ',  $str);
	return $new;
}
if ($argc == 2)
{
	echo erup($argv[1])."\n";
}	
?>
