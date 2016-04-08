<?php
	session_start();
	if (isset($_GET['login']) && isset($_GET['passwd']) 
		&& ($_GET['submit'] == "OK"))
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
			echo ($_SESSION['login']);
		?>" /></p>
		<p>Mot de passe <input type="password" name="passwd" value="<?php 
			echo ($_SESSION['passwd']);
		?>" /></p>
		<input type="submit" name="submit" value="OK"/>
	</form>
</body>
</html>