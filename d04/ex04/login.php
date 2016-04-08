<?php
include("./auth.php");

session_start();
if ($_POST['login'] !== NULL && $_POST['passwd'] !== NULL)
{
	$rep = auth($_POST['login'], $_POST['passwd']);
	if ($rep === TRUE)
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		echo "<iframe name='chat' width='100%' height='550px' src='chat.php'></iframe>";
		echo "<iframe name='speak' width='100%' height='200px' src='speak.php'></iframe>";
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
	}
}
?>