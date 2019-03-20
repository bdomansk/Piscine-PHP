#!/usr/bin/php
<?php
function ft_split($str)
{
	$str = trim($str);
	$new = preg_split("/[\s]+/",  $str);
	return $new;
}
function ft_compare($str1, $str2)
{
	$str1 = strtolower($str1);
    $str2 = strtolower($str2);
    $sort = "abcdefghijklmnopqrstuvwxyz0123456789!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
    $i = 0;
    while ($i < strlen($str1) && $i < strlen($str2))
    {
    	$temp1 = strpos($sort, $str1[$i]);
    	$temp2 = strpos($sort, $str2[$i]);
    	if ($temp1 > $temp2)
    		return (1);
    	if ($temp1 < $temp2)
    		return (0);
    	$i++;
    }
    if (strlen($str1) > strlen($str2))
    	return (1);
    else
    	return (0);
}
$arr = array();
for ($i = 1; $i < $argc ; $i++)
{
	$temp = ft_split($argv[$i]);
	foreach($temp as $word)
		$arr[] = $word;
}
usort($arr, "ft_compare");

foreach($arr as $word)
	echo $word . "\n";
?>