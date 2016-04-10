<?php
	session_start();
	// print_r($_SESSION);
	if ($_SESSION["error"])
	{
		echo "<div class=erreur>".$_SESSION["error"]."</div>";
		$_SESSION["error"] = "";
	}
	//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="UTF-8">
	<title>Boutique Gaming</title>
</head>
<body>
	<div class="global">
		<h1>Boutique Gaming</h1>
		<div class="entete">
			<div class="pub">
				<?php include("pub.php");?>
			</div>
		</div>
		<div id="content">
			<div class="col1-3 categorie box-shadow">
				<?php include("categorie.php");?>
			</div>
			<div class="col1-3 article box-shadow">
				<?php include("articles.php"); ?>
			</div>
			<div class="col1-3 panier box-shadow">
				<?php include("panier.php");?>
			</div>
		</div>
	</div>
</body>
</html>