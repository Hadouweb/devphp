	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="articles.css">
		<meta charset="UTF-8">
	</head>
	<body>

	</body>
	</html>
<?php
	include_once("functions.php");
	$ret = get_all_product();
	while ($row = mysqli_fetch_assoc($ret)) {
		echo "<img class=miniature alt=".$row["product_name"]." src=".$row["picture"]."></img><br/>";
		echo $row["product_name"]."<br/>";
		echo $row["product_desc"]."<br/>";
		if (!$row["stock"])
			echo "out of stock"."<br/>";
		echo $row["price"]."<br/>";
	}
?>