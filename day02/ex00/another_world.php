#!/usr/bin/php
<?php
function ft_split($str)
{
	$str = trim($str);
    $new = preg_replace("/\s+/", " ", $str);
    return $new;
}
if ($argc > 1)
{
	$str = ft_split($argv[1]);
	echo $str."\n";
}
?>