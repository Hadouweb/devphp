#!/usr/bin/php
<?php
if ($argc == 2)
{
	$str = trim($argv[1]);
	$tab = explode(' ', $str);
	$tab = array_filter($tab);
	foreach($tab as $word)
		echo "$word ";
	echo "\n";
}
?>