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
	var_dump($data);
	echo "</pre>";
}

function get_product_by_category($category_id)
{
	global $db;
	$sql = "SELECT * FROM `product` WHERE `category_id` = 1";
	$result = mysqli_query($db, $sql);
	$result = mysqli_fetch_assoc($result);
	if ($result !== FALSE)
		debug($result);
}
get_product_by_category(1);

?>