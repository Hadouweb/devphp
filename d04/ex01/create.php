<?php

session_start();

function ft_error()
{
	echo "ERROR\n";
	die();
}

function user_exist($tab, $login)
{
	foreach ($tab as $value)
	{
		if ($value["login"] === $login)
			return 0;
	}
	return 1;
}

if (isset($_POST['login']) && isset($_POST['passwd']) 
	&& ($_POST['submit'] == "OK"))
{
	if (!empty($_POST['login']) && !empty($_POST['passwd']))
	{
		if (file_exists("./private") === TRUE)
		{
			if (file_exists("./private/passwd") === TRUE)
			{
				$file = file_get_contents("./private/passwd");
				$tab = unserialize($file);
				if (user_exist($tab, $_POST['login']) === 0)
					ft_error();
			}
			else
				$tab = array();
			$user["login"] = $_POST['login'];
			$user["passwd"] = hash("whirlpool", $_POST['passwd']);
			$tab[] = $user;
			$data = serialize($tab);
			file_put_contents("./private/passwd", $data);
			echo "OK\n";
		}
		else
		{
			if (!mkdir("./private", 0777, false)) {
		    	die('Echec lors de la création du répertoire...');
			}
		}
	}
	else
		ft_error();
}
?>
