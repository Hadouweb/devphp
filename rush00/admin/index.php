<?php
	session_start();
	include_once("./functions.php");
	if (!isset($_SESSION['user']) || $_SESSION['user']['user_role'] !== "1")
	{
		header("Location: /");
		die();
	}
?>
<html class="no-js" lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Admin</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="admin.css">
</head>

<body>
<section id="sidebar"> 
	<div id="sidebar-nav">   
		<ul>
			<li <?php if (!isset($_GET['page'])) {echo "class='active'";} ?> ><a href="/admin"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
			<li <?php if ($_GET['page'] === "order") {echo "class='active'";} ?>><a href="/admin?page=order"><i class="fa fa-desktop"></i>Commandes</a></li>
			<li <?php if ($_GET['page'] === "category") {echo "class='active'";} ?>><a href="/admin?page=category"><i class="fa fa-desktop"></i>Catégories</a></li>
			<li <?php if ($_GET['page'] === "product") {echo "class='active'";} ?>><a href="/admin?page=product"><i class="fa fa-usd"></i>Produits</a></li>
			<li <?php if ($_GET['page'] === "user") {echo "class='active'";} ?>><a href="/admin?page=user"><i class="fa fa-pencil-square-o"></i>Utilisateurs</a></li>
			<li><a href="/"><i class="fa fa-pencil-square-o"></i>Boutique</a></li>
		</ul>
	</div>
</section>
<section id="content">
	<div class="content">
		<?php
		if ($_GET["page"] === "order")
			include_once("order.php");
		else if ($_GET["page"] === "user")
			include_once("user.php");
		else if ($_GET["page"] === "category")
			include_once("category.php");
		else if ($_GET["page"] === "product")
			include_once("product.php");
		else
		{
		?>
			<div class="content-header">
				<h1>Tableau de bord</h1>
			</div>
			<div class="widget-box sample-widget">
				<div class="widget-header">
					<h2>Widget Header</h2>
					<i class="fa fa-cog"></i>
				</div>
				<div class="widget-content">
					<p>bla bla </p>
				</div>
			</div>
		<?php } ?>
	</div>
</body>
</html>