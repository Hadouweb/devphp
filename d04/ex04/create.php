<?php

session_start();

function user_exist($tab, $login)
{
	foreach ($tab as $value)
	{
		if ($value["login"] === $login)
			return 0;
	}
	return 1;
}

function check($str)
{
	if ($str !== NULL && $str !== "")
		return 1;
}

function ft_create_user($login, $passwd)
{
	if (file_exists("../private") === FALSE)
	{
		if (!mkdir("../private", 0777, false)) {
	    	return FALSE;
		}
	}
	if (file_exists("../private/passwd") === TRUE)
	{
		@$file = file_get_contents("../private/passwd");
		if ($file === FALSE)
			return FALSE;
		$tab = unserialize($file);
		if (user_exist($tab, $_POST['login']) === 0)
			return FALSE;
	}
	else
		$tab = array();
	$user["login"] = $_POST['login'];
	$user["passwd"] = hash("whirlpool", $_POST['passwd']);
	$tab[] = $user;
	$data = serialize($tab);
	@$ret = file_put_contents("../private/passwd", $data);
	if ($ret === false)
		return FALSE;
	return TRUE;
}

if (check($_POST['login']) && check($_POST['passwd'])
	&& ($_POST['submit'] == "OK"))
{
	if (ft_create_user($_POST['login'], $_POST['passwd']) === TRUE)
	{
		header('Location: ./');
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
