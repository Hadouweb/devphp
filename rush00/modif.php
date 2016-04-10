<?php
	header("Location:register.php");
	session_start();
	include_once("admin/functions.php");
	if($_POST && $_POST["login"] && $_POST["pwd"] && $_POST["submit"] && $_POST["submit"] == "changer mot de passe" && $_POST["pwd2"])
	{
		if ($res = mysqli_fetch_assoc(get_user_by_username($_POST["login"])))
		{
			if ($_POST["pwd"] == $_POST["pwd2"])
				$_SESSION["error"] = "mots de passes identiques";
			else if ($res["password"] != hash("whirlpool", $_POST["pwd"]))
				$_SESSION["error"] = "mauvais mot de passe";
			else if (update_user($res["user_role"], $res["username"], 
				hash("whirlpool", $_POST["pwd2"]), $res["id"]) !== FALSE)
			{
				$_SESSION["error"] = "mot de passe change";
			}	
			else
				$_SESSION["error"] = "erreur sql";
		}
		else
			$_SESSION["error"] = "utilisateur introuvable";	
	}
	else if ($_POST["submit"] == "changer mot de passe")
		$_SESSION["error"] = "champ(s) vide(s)";
?>