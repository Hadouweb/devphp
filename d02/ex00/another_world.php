#!/usr/bin/php
<?php
if ($argc > 1)
{
	$result = preg_replace("/[.^ \t]+/", '\1 ', $argv[1]);
	echo $result."\n";
	echo trim($result)."\n";
}
?>