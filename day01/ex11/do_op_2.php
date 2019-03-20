#!/usr/bin/php
<?php
if ($argc == 2)
{
    $arr = sscanf($argv[1], "%d %c %d %s");
    if (is_null($arr[0]) || !$arr[1] || is_null($arr[2]) || !is_null($arr[3]))
    {
        echo "Syntax Error\n";
	}
    else
	{
        switch ($arr[1])
        {
            case ("/"):
                if ($arr[2] == 0)
                    echo "Error : / 0!";
                else
                    echo ($arr[0] / $arr[2]);
                break;
            case ("%"):
                if ($arr[2] == 0)
                    echo "Error : % 0!";
                else
                    echo ($arr[0] % $arr[2]);
                break;
            case ("*"):
                echo ($arr[0] * $arr[2]);
                break;
            case ("+"):
                echo ($arr[0] + $arr[2]);
                break;
            case ("-"):
                echo ($arr[0] - $arr[2]);
				break;
			case ($arr[1]):
				echo "Syntax Error";
				break;
		}
		echo "\n";
    }
}
else {
    echo "Incorrect Parameters\n";
}
?>
