#!/usr/bin/php
<?php
if ($argc == 4)
{
	if ($argv[2][0] == '+')
		echo (int)$argv[1] + (int)$argv[3];
	else if ($argv[2][0] == '-')
		echo (int)$argv[1] - (int)$argv[3];
	else if ($argv[2][0] == '*')
		echo (int)$argv[1] * (int)$argv[3];
	else if ($argv[2][0] == '/')
	{
		if ($argv[3] == '0')
			echo "Error : division by zero";
		else
			echo (int)$argv[1] / (int)$argv[3];
	}
	else if ($argv[2][0] == '%')
	{
		if ($argv[3] == '0')
			echo "Error : division by zero";
		else
			echo (int)$argv[1] % (int)$argv[3];
	}
	echo "\n";
}
else
	echo "Incorrect Parameters\n";
?>