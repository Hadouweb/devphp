<?php
	session_start();
	include_once("./admin/functions.php");
	if ($_SESSION["error"])
	{
		echo "<div class=erreur>".$_SESSION["error"]."</div>";
		$_SESSION["error"] = "";
	}
	if (check($_GET['order']))
	{
		if ($_SESSION['user'])
			set_order($_GET['order'], 1, $_SESSION['user']['id'], 0);
		else
		{
			$tmp_user = array();
			$tmp_user['user_role'] = "10";
			$tmp_user['username'] = "tmpuser".session_id();
			$tmp_user['password'] = hash("whirlpool", "hsdfjahfja");
			set_user($tmp_user['user_role'],$tmp_user['username'], $tmp_user['password']);
			$user = get_user_by_username($tmp_user['username']);
			$_SESSION['tmp_user'] = mysqli_fetch_assoc($user);
			set_order($_GET['order'], 1, $_SESSION['tmp_user']['id']);
		}
	}
	if (check($_GET['del_order']))
	{
		$order = mysqli_fetch_assoc(get_order_by_id($_GET['del_order']));
		if (isset($_SESSION['tmp_user']['id']) && $order['user_id'] === $_SESSION['tmp_user']['id'])
			delete_order($_GET['del_order']);
		else if (isset($_SESSION['user']['id']) && $order['user_id'] == $_SESSION['user']['id'])
			delete_order($_GET['del_order']);
	}
	if (check($_GET['valid_order']))
	{
		$ret = get_order_by_user_id($_SESSION["user"]["id"]);
		while ($row = mysqli_fetch_assoc($ret))
		{
			update_order($row['product_id'], $row['quantity'], 1, $row['id']);
			header("Location: /");
		}
	}
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
				<?php include("login.php"); ?>
			</div>
			<div class="col1-3 panier box-shadow">
				<p style="color:white;">Panier</p>
				<?php include("panier.php"); ?>
			</div>
		</div>
	</div>
</body>
</html>