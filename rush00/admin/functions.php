<?php
session_start();
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

function ft_format($str)
{
	$str = str_replace(' ', '-', $str);
	return (strtolower($str));
}

function check($str)
{
	if (isset($str) && $str !== "")
		return TRUE;
	else
		return FALSE;
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

function get_all_product_category_name()
{
	global $db;
	$sql = "SELECT product.*, category.category_name FROM `product` LEFT JOIN `category` on product.category_id = category.id";
	$result = mysqli_query($db, $sql);
	if ($result !== FALSE)
		return ($result);
	else
		return FALSE;
}

function get_order_by_user_id($user_id)
{
	global $db;
	$sql = "SELECT * FROM `order` WHERE `user_id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $user_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
}

function get_order_by_id($order_id)
{
	global $db;
	$sql = "SELECT * FROM `order` WHERE `id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $order_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
}

function get_product_by_category($category_id)
{
	global $db;
	$sql = "SELECT * FROM `product` WHERE `category_id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $category_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
}

function get_product_by_id($product_id)
{
	global $db;
	$sql = "SELECT * FROM `product` WHERE `id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $product_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
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
	$sql = "SELECT * FROM `category` WHERE `id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $category_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
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
	$sql = "SELECT * FROM `user` WHERE `user_role` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $id_role);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
}

function get_user_by_id($id_user)
{
	global $db;
	$sql = "SELECT * FROM `user` WHERE `id` = (?)";
	$stmt = mysqli_prepare($db, $sql);
	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $id_user);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
}

function get_user_by_username($username)
{
	global $db;
	$sql = "SELECT * FROM `user` WHERE `username` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "s", $username);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $result;
}

function set_order($product_id, $quantity, $user_id)
{
	global $db;
	$sql = "INSERT INTO `order` (`product_id`, `quantity`, `user_id`) VALUES (?, ?, ?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "iii", $product_id, $quantity, $user_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function update_order($product_id, $quantity, $valid_order, $order_id)
{
	global $db;
	$sql = "UPDATE `order` SET `product_id` = (?), `quantity` = (?), `valid_order` = (?) WHERE `order`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "iiii", $product_id, $quantity, $valid_order, $order_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function update_product($product_name, $product_desc, $stock, $price, $picture, $category_id, $product_id)
{
	global $db;
	$sql = "UPDATE `product` SET 
	`product_name` = (?), `product_desc` = (?), `stock` = (?), `price` = (?),
	`picture` = (?), `category_id` = (?) WHERE `product`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "ssissii",
		htmlspecialchars($product_name), htmlspecialchars($product_desc), $stock, htmlspecialchars($price),
		$picture, $category_id, $product_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function set_user($user_role, $username, $password)
{
	global $db;
	if ($user_role !== "1" && $user_role !== "10")
		return FALSE;
	if ($username === "" || $password === hash("whirlpool", ""))
		return FALSE;
	$sql = "INSERT INTO `user` (`user_role`, `username`, `password`) VALUES (?, ?, ?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "iss", $user_role, htmlspecialchars($username), $password);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function set_product($product_name, $product_desc, $stock, $price, $picture, $category_id)
{
	global $db;
	$sql = "INSERT INTO `product` (`product_name`, `product_desc`, `stock`, `price`, `picture`, `category_id`, `date_added`) VALUES (?, ?, ?, ?, ?, ?, NOW())";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "ssissi", htmlspecialchars($product_name),
		htmlspecialchars($product_desc), $stock, htmlspecialchars($price), htmlspecialchars($picture), $category_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}


function delete_product($product_id)
{
	global $db;
	$sql = "DELETE FROM `product` WHERE `product`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $product_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function delete_order($order_id)
{
	global $db;
	$sql = "DELETE FROM `order` WHERE `order`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $order_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function set_category($category_name, $picture)
{
	global $db;
	$sql = "INSERT INTO `category` (`category_name`, `picture`) VALUES (?, ?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "ss", htmlspecialchars($category_name), htmlspecialchars($picture));
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function delete_user($user_id)
{
	global $db;
	$sql = "DELETE FROM `user` WHERE `user`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "i", $user_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

function update_user($user_role, $username, $password, $user_id)
{
	global $db;
	if ($user_role !== "1" && $user_role !== "10")
		return FALSE;
	if ($username === "" || $password === hash("whirlpool", ""))
		return FALSE;
	$sql = "UPDATE `user` SET `user_role` = (?), `username` = (?), `password` = (?) WHERE `user`.`id` = (?)";
	$stmt = mysqli_prepare($db, $sql);

	if ($stmt === FALSE)
		return FALSE;
	$bind = mysqli_stmt_bind_param($stmt, "issi", $user_role, htmlspecialchars($username), $password, $user_id);
	if ($bind === FALSE)
		return FALSE;
	$exec = mysqli_stmt_execute($stmt);
	if ($exec === FALSE)
		return FALSE;
	mysqli_stmt_close($stmt);
}

//$ret = delete_user(9);
//while ($row = mysqli_fetch_assoc($ret)) {
//	debug($ret);
//}
?>