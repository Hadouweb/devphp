<?php
	session_start();
	// print_r($_SESSION);
	if ($_SESSION["error"])
	{
		echo "<div class=erreur>".$_SESSION["error"]."</div>";
		$_SESSION["error"] = "";
	}
	var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="UTF-8">
	<title>UN TITRE BORDEL</title>
</head>
<body>
	<div class="global">
		<h1>TITRE</h1>
		<div class="entete">
			<div class="pub">
				<?php include("pub.php");?>
			</div>
			<div >
				
			</div>
		</div>
		<div class="categorie">
			<?php include("categorie.php");?>
		</div>
		<div class="article">
			<?php include("articles.php");?>
		</div>
		<div class="panier">
			<?php include("panier.php");?>
		</div>
	</div>
</body>
</html>