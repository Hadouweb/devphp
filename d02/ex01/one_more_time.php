#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

function wrong_format()
{
	echo "Wrong Format\n";
	exit (1);
}

function check_day($day)
{
	$pattern = "/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)$/";
	if (preg_match($pattern, $day, $matches))
		return (1);
	return (0);
}

function check_day_num($day_num)
{
	if (preg_match("/^[0-9]{1,2}$/", $day_num, $matches))
		return (1);
	return (0);
}

function check_day_month($month)
{
	$pattern = "/^[Jj]anvier|[Ff](e|é)vrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]o(u|û)t|[Ss]eptembre|[Oo]ctrobre|[Nn]ovembre|[Dd]ecembre$/";
	if (preg_match($pattern, $month, $matches))
		return (1);
	return (0);
}

function check_year($year)
{
	if (preg_match("/^[0-9]{4}$/", $year, $matches))
		return (1);
	return (0);
}

function check_time($time)
{
	if (preg_match("/^[0-9][0-9]:[0-9][0-9]:[0-9][0-9]$/", $time, $matches))
		return (1);
	return (0);
}

if ($argc > 1)
{
	$a = explode(' ', $argv[1]);
	if (check_day($a[0]) == 0)
		wrong_format();
	if (check_day_num($a[1]) == 0)
		wrong_format();
	if (check_day_month($a[2]) == 0)
		wrong_format();
	if (check_year($a[3]) == 0)
		wrong_format();
	if (check_time($a[4]) == 0)
		wrong_format();
	$argv[1] = preg_replace("/[Ff]evrier/", "Février", $argv[1]);
	$argv[1] = preg_replace("/[Aa]out/", "Août", $argv[1]);
	$d = strptime($argv[1], '%A %d %B %Y %T');
	$date = mktime($d[tm_hour], $d[tm_min], $d[tm_sec], $d[tm_mon]+1,
		$d[tm_mday], $d[tm_year]+1900);
	if ($d == false)
		wrong_format();
	else
		echo $date."\n";
}
?>