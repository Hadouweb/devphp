#!/usr/bin/php
<?php
function ft_is_alpha($str)
{
	if ($str[0] >= 'A' && $str[0] <= 'Z' || 
		$str[0] >= 'a' && $str[0] <= 'z')
		return (1);
	else
		return (0);
}

if ($argc >= 2)
{
	$final = array();
	foreach ($argv as $key => $arg) {
		if ($key != 0)
		{
			$str = trim($arg);
			$str = $arg;
			$tab = explode(' ', $str);
			$tab = array_filter($tab);
			foreach($tab as $word)
				array_push($final, $word);
		}
	}
	$alpha = array();
	$num = array();
	$other = array();
	foreach($final as $word)
	{
		if (ft_is_alpha($word))
			array_push($alpha, $word);
		else if (is_numeric($word))
			array_push($num, $word);
		else
			array_push($other, $word);
	}
	sort($alpha, SORT_STRING | SORT_FLAG_CASE);
	sort($num, SORT_STRING | SORT_FLAG_CASE);
	sort($other, SORT_STRING | SORT_FLAG_CASE);
	$final = array_merge($alpha, $num, $other);
	foreach ($final as $word)
		echo "$word\n";
}
?>