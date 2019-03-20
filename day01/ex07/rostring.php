#!/usr/bin/php
<?php
function ft_split($str)
{
	$str = trim($str);
	$new = preg_split("/[\s]+/",  $str);
	return $new;
}
if ($argc > 1)
{	
	$arr = ft_split($argv[1]);
	$first = array_shift($arr);
	foreach($arr as $word)
		echo $word . " ";
	echo $first . "\n";
}
?>