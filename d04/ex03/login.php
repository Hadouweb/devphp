<?php
include("./auth.php");

session_start();
if ($_GET['login'] !== NULL && $_GET['passwd'] !== NULL)
{
	$rep = auth($_GET['login'], $_GET['passwd']);
	if ($rep === TRUE)
	{
		$_SESSION['loggued_on_user'] = $_GET['login'];
		echo "OK\n";
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
	}
}
else
	echo "ERROR\n";
?>