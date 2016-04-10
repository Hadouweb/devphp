	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="categorie.css">
		<meta charset="UTF-8">
	</head>
	<body>

	</body>
	</html>
<?php
	include_once("functions.php");
	$ret = get_all_category();
	while ($row = mysqli_fetch_assoc($ret)) {
		echo "<img class=miniature alt=".$row["category_name"]." src=".$row["picture"]."></img><br/>";
	}
?>