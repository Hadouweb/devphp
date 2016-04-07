#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
$content = file_get_contents("/var/run/utmpx");
$tab = array();
while ($content != "")
{
	$unpacked = unpack("A256user/A4id/A32ttyname/ipid/itype/lloginsec/lloginus/A256host/A64pad", $content);
	if ($unpacked['type'] == 7)
		$tab[] = $unpacked['user'] . " " . $unpacked['ttyname'] . "  " . strftime("%b %e %R", $unpacked['loginsec']) . PHP_EOL;
	$content = substr($content, 628);
}
ksort($tab);
$i = 0;
while ($i < count($tab))
{
	print($tab[$i]);
	$i++;
}

?>