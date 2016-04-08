<?php
session_start();
if ($_GET['login'] !== NULL && $_GET['passwd'] !== NULL
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
	<form method="GET" action="index.php">
		Identifiant: <input type="text" name="login" value="<?php echo ($_SESSION['login']); ?>" />		
		<br />
		Mot de passe: <input type="password" name="passwd" value="<?php echo ($_SESSION['passwd']); ?>" />
		<input type="submit" name="submit" value="OK"/>
	</form>
</body>
</html>