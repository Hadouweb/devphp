<?php
	header("Location:register.php");
	session_start();
	include_once("./admin/functions.php");
	if($_POST && $_POST["login"] && $_POST["pwd"] && $_POST["submit"] && $_POST["submit"] == "creer" && $_POST["pwd2"])
	{

		if ($res = mysqli_fetch_assoc(get_user_by_username($_POST["login"])))
			$_SESSION["error"] = "cet utilisateur éxiste déjà";
		else if (!$_SESSION["error"] && $_POST["pwd"] != $_POST["pwd2"])
			$_SESSION["error"] = "mots de passes différents";
		if (!$_SESSION["error"])
		{

			$username = $_POST["login"];
			$pwd = hash("whirlpool", $_POST["pwd"]);
			if (set_user("10", $username, $pwd) !== TRUE)
				$_SESSION["error"] = "bienvenue ". htmlspecialchars($username);
			else
				$_SESSION["error"] = "erreur sql";
		}
	}
	else if ($_POST["submit"] == "creer")
		$_SESSION["error"] = "champ(s) vide(s)";
?>