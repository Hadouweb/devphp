<?php

if (file_exists('list.csv'))
{
	@$content = file_get_contents('list.csv');
	if ($content === FALSE)
		die("Error: Impossible de lire le fichier");
	if ($content !== "")
		echo $content;
}
else
	die("Error");

?>