#!/usr/bin/php
<?php
if ($argc == 4)
{
    $x = trim($argv[1]);
    $op = trim($argv[2]);
    $y = trim($argv[3]);
    switch ($op)
    {
        case ("/"):
            if ($y == 0)
                echo "Error : / 0!";
            else
                echo ($x / $y);
            break;
        case ("%"):
            if ($y == 0)
                echo "Error : % 0!";
            else
                echo ($x % $y);
            break;
        case ("*"):
            echo ($x * $y);
            break;
        case ("+"):
            echo ($x + $y);
            break;
        case ("-"):
            echo ($x - $y);
            break;
    }
}
else {
    echo "Incorrect Parameters";
}
echo "\n";
?>