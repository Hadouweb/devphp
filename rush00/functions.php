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

function get_user_by_id($id_user)
{
	global $db;
	$sql = "SELECT * FROM `user` WHERE `id` = $id_user";
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

function set_user($role, $username, $password)
{
	global $db;
	$sql = "INSERT INTO `user` (`user_role`, `username`, `password`) VALUES (?, ?, ?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === false)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "iss", $role, $username, $password);
	if ($bind === false)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === false)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function set_product($product_name, $product_desc, $stock, $price, $picture, $category_id)
{
	global $db;
	$sql = "INSERT INTO `product` (`product_name`, `product_desc`, `stock`, `price`, `picture`, `category_id`, `date_added`) VALUES (?, ?, ?, ?, ?, ?, NOW())";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === false)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "ssiiss", $product_name, $product_desc, $stock, $price, $picture, $category_id);
	if ($bind === false)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === false)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function set_category($category_name, $picture)
{
	global $db;
	$sql = "INSERT INTO `category` (`category_name`, `picture`) VALUES (?, ?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === false)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "ss", $category_name, $picture);
	if ($bind === false)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === false)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function delete_user($user_id)
{
	global $db;
	$sql = "DELETE FROM `user` WHERE `user`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === false)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $user_id);
	if ($bind === false)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === false)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function update_user($user_role, $username, $password, $user_id)
{
	global $db;
	$sql = "UPDATE `user` SET `user_role` = (?), `username` = (?), `password` = (?) WHERE `user`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === false)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "issi", $user_role, $username, $password, $user_id);
	if ($bind === false)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === false)
		return FALSE;
	mysqli_stmt_close($stmt);
}

$ret = delete_user(9);
//while ($row = mysqli_fetch_assoc($ret)) {
	debug($ret);
//}
?>