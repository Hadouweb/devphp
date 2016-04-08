<?php

session_start();

function ft_error()
{
	echo "ERROR\n";
	die();
}

function user_exist($tab, $login, $oldpwd)
{
	foreach ($tab as $key => $value)
	{
		if ($value["login"] === $login && 
			$value["passwd"] === hash("whirlpool", $oldpwd))
			return $key;
	}
	return -1;
}

if (isset($_POST['login']) && isset($_POST['oldpw']) &&
	isset($_POST['newpw']) && ($_POST['submit'] == "OK"))
{
	if (!empty($_POST['login']) && !empty($_POST['oldpw']) 
		&& !empty($_POST['newpw']))
	{
		if (file_exists("./private") === FALSE)
			ft_error();
		if (file_exists("./private/passwd") === TRUE)
		{
			$file = file_get_contents("./private/passwd");
			$tab = unserialize($file);
			$user_id = user_exist($tab, $_POST['login'], $_POST['oldpw']);
			if ($user_id === -1)
				ft_error();
			else
			{
				$tab[$user_id]["passwd"] = hash("whirlpool", $_POST['newpw']);
				$data = serialize($tab);
				file_put_contents("./private/passwd", $data);
			}
		}
		else
			ft_error();
		echo "OK\n";
	}
	else
		ft_error();
}
?>
