#!/usr/bin/php
<?php
if ($argv > 1)
{
	@$page = file_get_contents($argv[1]);
	if ($page == false)
		echo "Impossible d'oubrir le fichier\n";
	else
	{
		/*$page = htmlentities($page);
		$page = explode('&lt;', $page);
		$page = array_map('html_entity_decode', $page);
		html_entity_decode($page);
		var_dump($page);*/
		$page = preg_replace_callback("/title/", 
			function ($matches) {
				return strtoupper($matches[0]);
			},
			$page
		);
		echo $page;
	}
}
?>