#!/usr/bin/php
<?php
$res = NULL;
for ($i = 2; $i < $argc; $i++) {
    $temp = explode(':', $argv[$i]);
    if ($temp[0] == $argv[1])
   	    $res = $temp[1];
}
if (!is_null($res))
    echo "$res\n";
?>