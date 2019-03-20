<?php
function ft_split($str) 
{
	$str = trim($str);
    $arr = preg_split("/[\s]+/", $str);
    sort($arr);
    return $arr;
}
?>
