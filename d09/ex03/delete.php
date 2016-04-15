<?php

if ($_SERVER['REQUEST_METHOD'] === "DELETE")
{
	$data = file_get_contents('php://input');
	$id = str_replace('id=', '', $data);
	if (is_numeric($id) === TRUE) {
		@$content = file_get_contents('list.csv');
		if ($content === FALSE)
			die("Error: Impossible de lire le fichier");
		$content = explode(PHP_EOL, $content);
		foreach ($content as $elem) {
			$elem = explode(';', $elem);
			if ($elem[0] == $id)
				$str = implode(';', $elem) . PHP_EOL;
		}
		$content = implode(PHP_EOL, $content);
		$content = str_replace($str, '', $content);
		if (@file_put_contents('list.csv', $content) === FALSE)
			die("Error: impossible d'ecrire dans le fichier");
	} else {
		die("Error: impossible de trouver l'element");
	}
}

?>