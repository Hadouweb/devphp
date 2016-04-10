<?php
	include_once("./admin/functions.php");
	session_start();
	session_destroy();
	session_start();
	$user = get_user_by_username("tmpuser".session_id());
	$_SESSION['tmp_user'] = mysqli_fetch_assoc($user);
	//debug($_SESSION);
	header("Location:index.php");
?>