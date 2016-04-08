<?php
	session_start();
	if ($_GET['login'] && $_GET['passwd'] && ($_GET['submit'] == "OK"))
	{
			$_SESSION['login'] = $_GET['login'];
			$_SESSION['passwd'] = $_GET['passwd'];
	}
?>

<html>
<head>
	<meta charset="UTF-8" />
</head>
<body>
	<form method="get" action="index.php">
		<p>Identifiant <input type="text" name="login" value="<?php 
		if ($_SESSION['login'] === $_GET['login'])
			echo ($_SESSION['login']);
		else
			echo "";
		?>" /></p>
		<p>Mot de passe <input type="password" name="passwd" value="<?php 
		if ($_SESSION['passwd'] === $_GET['passwd'])
			echo ($_SESSION['passwd']);
		else
			echo "";
		?>" /></p>
		<input type="submit" name="submit" value="OK"/>
	</form>
</body>
</html>