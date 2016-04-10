<?php
	session_start();
	header("Location:index.php");
	include_once("functions.php");
	if ($_POST && $_POST["login"] && $_POST["pwd"] && $_POST["submit"] && $_POST["submit"] == "connect")
	{
		if ($res = get_all_user())
		{
			while ($row = mysqli_fetch_assoc($res)) 
			{
				if ($row["username"] == $_POST["login"] && $row["password"] == $_POST["pwd"])
				{
					$_SESSION["logged_on_user"] = $row["username"];
					$_SESSION["user"] = $row;
					print_r($_SESSION);
					break;
				}
			}
			if (!$_SESSION["logged_on_user"])
				$_SESSION["error"] = "echec identification";
		}
		else
			$_SESSION["error"] = "mauvais identifiant";
	}
	else if ($_POST["submit"] == "connect")
		$_SESSION["error"] = "champ(s) vide(s)";
?>