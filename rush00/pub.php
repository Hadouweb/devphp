<?php
	include_once("./admin/functions.php");
	$data_products = get_all_product();
	$tab = array();
	while ($row = mysqli_fetch_assoc($data_products)) {
		$tab[] = $row['picture'];
	}

	echo "<marquee loop='infinite' scrollamount=10 onmouseover=this.stop() onmouseout=this.start()>";
	foreach ($tab as $key => $value) {
		echo "<img class=img_roll src = $value></img>";
	}
	echo "</marquee>";
?>