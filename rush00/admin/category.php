<?php
	session_start();
	include_once("./functions.php");
	if (!isset($_SESSION['user']) || $_SESSION['user']['user_role'] !== "1")
	{
		header("Location: /");
		die();
	}
?>
<div class="content-header">
	<h1>Catégories</h1>
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