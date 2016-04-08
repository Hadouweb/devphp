<?php
if ($_GET['action'] == "set" && $_GET['name'] !== NULL && $_GET['value'] !== NULL)
   setcookie($_GET['name'], $_GET['value'], 0);
else if ($_GET['action'] == "get" && $_GET['name'] !== NULL)
{
	$tmp = $_COOKIE[$_GET['name']];
	echo $tmp."\n";
}
else if ($_GET['action'] == "del" && $_GET['name'] !== NULL)
	setcookie($_GET['name'], "", time() - 3600);
?>