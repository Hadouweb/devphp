#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
$file = file_get_contents("/var/run/utmpx");
$tab = array();
$tab_content = str_split($file, 628);
foreach ($tab_content as $content)
{
	$unpacked = unpack("a256user/a4id/a32tty/ipid/itype/ltime", $content);
	if ($unpacked['type'] == 7)
		$tab[] = $unpacked['user'] . " " . $unpacked['tty'] . "  " . strftime("%b %e %R", $unpacked['time']) . PHP_EOL;
}
ksort($tab);
$i = 0;
while ($i < count($tab))
{
	print($tab[$i]);
	$i++;
}
?>