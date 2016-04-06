#!/usr/bin/php
<?php
function replace_toupper($matches) 
{
	var_dump($matches);
	//$final = preg_replace("/$matches[1]/", strtoupper($matches[1]), $matches[0]);
	return $final;
}

if ($argv > 1)
{
	@$page = file_get_contents($argv[1]);
	if ($page == false)
		echo "Impossible d'oubrir le fichier\n";
	else
	{
		//'/title=\"(.*)\"/Uis'
		$pattern = array('!<a[^>]*>(.*)</a>!Uis');
		$page = preg_replace_callback($pattern, 
			"replace_toupper",
			$page
		);
		echo $page;
	}
}
?>