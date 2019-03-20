#!/usr/bin/php
<?php
function ft_split($str)
{
	$str = trim($str);
	$new = preg_split("/[\s]+/",  $str);
	return $new;
}
$arr = array();
for ($i = 1; $i < $argc ; $i++)
{
	$temp = ft_split($argv[$i]);
	foreach($temp as $word)
		$arr[] = $word;
}
sort($arr);
foreach($arr as $word)
	echo $word . "\n";
?>
