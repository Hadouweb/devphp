<?php 
	session_start();
	include_once("./admin/functions.php");
	echo "<header class=head>";
	if (isset($_SESSION["user"]) && $_SESSION["user"]["user_role"] === "1")
		echo "<div><a style='text-align:center;width: 90%;' target='_blank'class='button' href=/admin>Administration</a></div><br />";
	if (!$_SESSION || !$_SESSION["user"])
	{
		echo "<div><form method='POST' action=connect.php>";
		echo "Identifiant:<br/> <input type=text name=login><br/>";
		echo "Mot de passe:<br/> <input type=password name=pwd><br/>";
		echo "<input class='button' type=submit name=submit value=Connexion>";
		echo "</form></div>";
		echo "<a class='button' href=create.php>Créer un compte</a>";
	}
	else
	{
		echo "<div><a class='button' href=create.php>Changer de mot de passe</a><br/></div>";
		echo "<form method=POST action=deconnect.php>";
		echo "<br /><input class='button' type=submit name=submit value=Déconnexion>";
		echo "</form>";
	}
	//debug($_SESSION);
	echo "</header>";
?>
