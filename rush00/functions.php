<?php
$servername = "localhost";
$username = "root";
$password = "localhost";
$dbname = "db_rush";

$db = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno())
	die("Failed to connect to MySQL: " . mysqli_connect_error(). "<br />");
mysqli_set_charset($db, "utf8");

function debug($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function get_all_product()
{
	global $db;
	$sql = "SELECT * FROM `product`";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

function get_product_by_category($category_id)
{
	global $db;
	$sql = "SELECT * FROM `product` WHERE `category_id` = $category_id";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

function get_all_category()
{
	global $db;
	$sql = "SELECT * FROM `category`";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

function get_category_by_id($category_id)
{
	global $db;
	$sql = "SELECT * FROM `category` WHERE `id` = $category_id";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

function get_all_user()
{
	global $db;
	$sql = "SELECT * FROM `user`";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

function get_user_by_username($username)
{
	global $db;
	$sql = "SELECT * FROM `user` WHERE `username` = $username";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

function get_user_by_role($id_role)
{
	global $db;
	$sql = "SELECT * FROM `user` WHERE `user_role` = $id_role";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

?>