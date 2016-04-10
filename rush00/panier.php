<?php
	session_start();
	echo "<header class=head>";
	if (isset($_SESSION["user"]) && $_SESSION["user"]["user_role"] === "1")
		echo "<a href=/admin>Administration</a><br />";
	if ($_SESSION && !$_SESSION["logged_on_user"])
	{
		echo "<form method=POST action=connect.php>";
		echo "id<input type=text name=login><br/>";
		echo "mdp<input type=password name=pwd><br/>";
		echo "<input type=submit name=submit value=connect>";
		echo "<a href=create.php>mdp oublié</a>";
		echo "</form>";
	}
	else
	{
		echo "nombre d'articles : 5<br/>";
		echo "prix : 95balles bordel!!!";
		echo "<form method=POST action=deconnect.php>";
		echo "<input type=submit name=submit value=deconnect>";
		echo "</form>";
	}
	echo "</header>";
	$tab = array("na" => "ok", "a" => "pan", "nae" => "ier");
	foreach ($tab as $key => $value) {
		echo "$value<br/>";
	}
?>