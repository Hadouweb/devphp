<?php
	session_start();
	//header("Location:index.php");
	include_once("./admin/functions.php");
	if ($_POST && $_POST["login"] && $_POST["pwd"] && $_POST["submit"] && $_POST["submit"] == "Connexion")
	{
		if ($res = get_all_user())
		{
			while ($row = mysqli_fetch_assoc($res)) 
			{
				$pwd = hash("whirlpool", $_POST["pwd"]);
				if ($row["username"] == $_POST["login"] && $row["password"] == $pwd)
				{
					$_SESSION["logged_on_user"] = $row["username"];
					$_SESSION["user"] = $row;
					$_SESSION["tmp_user"] = "";
					break;
				}
			}
			if (!$_SESSION["logged_on_user"])
				$_SESSION["error"] = "echec identification";
		}
		else
			$_SESSION["error"] = "mauvais identifiant";
	}
	else if ($_POST["submit"] == "Connexion")
		$_SESSION["error"] = "champ(s) vide(s)";
	header("Location:index.php");
?>