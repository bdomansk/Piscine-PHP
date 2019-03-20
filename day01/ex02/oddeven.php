#!/usr/bin/php
<?php
	$stdin = fopen("php://stdin", "r");
	while ($stdin && !feof($stdin))
	{
		echo "Enter a number: ";
		$line = fgets($stdin);
		if ($line) {
			$number = trim($line," \t\n\r\0");
			if (is_numeric($number))
            {
             	if ($number % 2 == 0)
                    echo "The number $number is even\n";
                else
                    echo "The number $number is odd\n";
            }
            else
                echo "'" . $number . "' is not a number\n";
		}
	}
	echo "\n";
	fclose($stdin);
?>
