<?php

if (file_exists('list.csv') && isset($_POST['id']) && isset($_POST['text']))
{
	$str = $_POST['id'] . ";" . $_POST['text'] . PHP_EOL;
	if (@file_put_contents('list.csv', $str, FILE_APPEND) === FALSE)
		die("Error: impossible d'ecrire dans le fichier");
}
else
	die("Error");

?>
