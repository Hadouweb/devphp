#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");
if ($argc > 1)
{
	$argv[1] = trim($argv[1]);
	$a = explode(' ',$argv[1]);
	$d = strptime($argv[1], '%A %d %B %Y %T');
	$date = mktime($d[tm_hour], $d[tm_min], $d[tm_sec], $d[tm_mon]+1,
		$d[tm_mday], $d[tm_year]+1900);
	if ($d == false)
		echo "Wrong Format\n";
	else
		echo $date."\n";
}
?>