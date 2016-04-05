#!/usr/bin/php
<?php
if ($argc == 4)
{
	$op = $argv[1].$argv[2].$argv[3];
	$result = eval('return '.$op.';');
	echo "$result\n";
}
else
	echo "Incorrect Parameters\n";
?>