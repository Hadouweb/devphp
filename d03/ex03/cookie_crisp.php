<?php
if ($_GET['action'] == "set")
   setcookie($_GET['name'], $_GET['value'], 0);
else if ($_GET['action'] == "get")
{
	$tmp = $_COOKIE[$_GET['name']];
	if ($tmp)
	   echo $tmp."\n";
}
else if ($_GET['action'] == "del")
	 setcookie($_GET['name'], "", time() - 3600);
?>