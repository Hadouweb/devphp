<?php
function auth($login, $passwd)
{
	@$file = file_get_contents("../private/passwd");
	if ($file === false)
		ft_error();
	$tab = unserialize($file);
	foreach ($tab as $key => $value)
	{
		if ($value["login"] === $login && 
			$value["passwd"] === hash("whirlpool", $passwd))
			return TRUE;
	}
	return FALSE;
}
?>