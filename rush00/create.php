<?php
	header("Location:register.php");
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "localhost";
	$dbname = "db_rush";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8");

	if($_POST && $_POST["login"] && $_POST["pwd"] && $_POST["submit"] && $_POST["submit"] == "creer" && $_POST["pwd2"])
	{
		$sql = "select * from user";
		if (($res = mysqli_query($conn, $sql)))
		{
			while ($obj = mysqli_fetch_assoc($res)) {
				if (strtolower($obj["username"]) == strtolower($_POST["login"]))
					$_SESSION["error"] = "cet utilisateur éxiste déjà";
				if ($_POST["pwd"] != $_POST["pwd2"])
					$_SESSION["error"] = "mots de passes différents";
				if ($_SESSION["error"])
					break;
			}
			$res->close();
		}
		if (!$_SESSION["error"])
		{
			$username = $_POST["login"];
			 $pwd = hash("whirlpool", $_POST["pwd"]);
			// $pwd = $_POST["pwd"];
			$sql = "INSERT INTO `user` (`user_type`, `username`, `password`, `is_logged`) VALUES ('2', '$username', '$pwd', 0)";
			if (mysqli_query($conn, $sql) === TRUE)
				$_SESSION["error"] = "bienvenue $username";
			else
				$_SESSION["error"] = "erreur sql";
		}
	}
	else if ($_POST["submit"] == "creer")
		$_SESSION["error"] = "champ(s) vide(s)";
	$conn->close();
?>