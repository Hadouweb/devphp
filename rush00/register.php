<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="UTF-8">
	<title>register</title>
</head>
<body>
<div >
	<?php
		if ($_SESSION["error"])
		{
			echo "<div class=erreur>".$_SESSION["error"]."</div>";
			$_SESSION["error"] = "";
		}
	?>
	<div class="gauche">
		<form method="POST" action="create.php">
			Identifiant
			<br/><input type="text" name="login"></input><br/>
			Mot de passe
			<br/><input type="password" name="pwd"></input><br/>
			Confirmer Mot de passe
			<br/><input type="password" name="pwd2"></input><br/>
			<input type="submit" name="submit" value="creer"></input><br/>
		</form>
	</div>
	<div class="droite">
		<form method="POST" action="modif.php">
			Identifiant<br/><input type="text" name="login"></input><br/>
			Ancien mot de passe<br/><input type="password" name="oldpw"></input><br/>
			Nouveau mot de passe<br/><input type="password" name="newpw"></input><br/>
			<input type="submit" name="submit" value="changer mot de passe"></input>
		</form>
	</div>
</div>
</body>
</html>