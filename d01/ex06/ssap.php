#!/usr/bin/php
<?php
if ($argc >= 2)
{
	$final = array();
	foreach ($argv as $arg) {
		$str = trim($arg);
		$tab = explode(' ', $str);
		$tab = array_filter($tab);
		foreach($tab as $word)
			array_push($final, $word);
	}
	sort($final);
	foreach($final as $word)
		echo $word."\n";
}
?>