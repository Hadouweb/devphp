#!/usr/bin/php
<?php
function epur_str($str)
{
	$str = trim($str, ' ');
	$tab = explode(' ', $str);
	$tab = array_filter($tab);
	foreach($tab as $word)
		$final .= " ".$word;
	return trim($final);
}

$array = array();
for ($i = 1; $i < $argc; $i++)
	$array = array_merge($array, explode(' ', epur_str($argv[$i])));

function order_char($c1, $c2)
{
	if (ctype_alpha($c1) && !ctype_alpha($c2))
		return -1;
	if (ctype_alpha($c2) && !ctype_alpha($c1))
		return 1;
	if (ctype_alpha($c1) && ctype_alpha($c2))
		return ord(strtolower($c1)) - ord(strtolower($c2));
	if (ctype_digit($c1) && !ctype_digit($c2))
		return -1;
	if (ctype_digit($c2) && !ctype_digit($c1))
		return 1;
	return (ord($c1) - ord($c2));
}

function order_str($s1, $s2)
{
	$i = 0;
	while (isset($s1[$i]) && isset($s2[$i]))
	{
		$cmp_char = order_char($s1[$i], $s2[$i]);
		if ($cmp_char)
			return $cmp_char;
		$i++;
	}
	if (isset($s1[$i]) && !isset($s2[$i]))
		return 1;
	if (!isset($s1[$i]) && isset($s2[$i]))
		return -1;
}

usort($array, 'order_str');
foreach($array as $mot)
	echo $mot . "\n";
?>