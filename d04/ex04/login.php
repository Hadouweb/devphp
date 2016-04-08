<?php
include("./auth.php");

session_start();
if ($_POST['login'] !== NULL && $_POST['passwd'] !== NULL)
{
	$rep = auth($_POST['login'], $_POST['passwd']);
	if ($rep === TRUE)
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		echo "OK\n";
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
	}
}
?>