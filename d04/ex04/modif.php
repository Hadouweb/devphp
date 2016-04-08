<?php

function user_exist($tab, $login, $oldpwd)
{
	foreach ($tab as $key => $value)
	{
		if ($value["login"] === $login && 
			$value["passwd"] === hash("whirlpool", $oldpwd))
			return $key;
	}
	return FALSE;
}

function check($str)
{
	if ($str !== NULL && $str !== "")
		return 1;
}

function modif_user($login, $oldpw, $newpw)
{
	@$file = file_get_contents("../private/passwd");
	if ($file === FALSE)
		return FALSE;
	$tab = unserialize($file);
	$user_id = user_exist($tab, $_POST['login'], $_POST['oldpw']);
	if ($user_id === FALSE)
		return FALSE;
	else
	{
		$tab[$user_id]["passwd"] = hash("whirlpool", $_POST['newpw']);
		$data = serialize($tab);
		@$ret = file_put_contents("../private/passwd", $data);
		if ($ret === FALSE)
			return FALSE;
	}
	return TRUE;
}

if (check($_POST['login']) && check($_POST['oldpw']) &&
	check($_POST['newpw']) && ($_POST['submit'] == "OK"))
{
	if (modif_user($_POST['login'], $_POST['oldpw'], $_POST['newpw']) === TRUE)
	{
		header("Refresh:1; url=./");
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
