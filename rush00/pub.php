<?php
	$tab = array("https://i.ytimg.com/vi/Fkg5UVTsKCE/maxresdefault.jpg");
	$tab[] = ("http://www.jeux-consoles.net/img/9729_mario_sonic.jpg");
	$tab[] = ("http://img2.hebus.com/hebus_2013/01/16/preview/1358349008_3557.jpg");

	echo "<marquee scrollamount=10 onmouseover=this.stop() onmouseout=this.start()>";
	foreach ($tab as $key => $value) {
		echo "<img class=img_roll src = $value></img>";
	}
	echo "</marquee>";
?>