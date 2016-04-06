#!/usr/bin/php
<?php
	while (1)
	{
		echo "Entrez un nombre: ";
		$str = fgets(STDIN);
		if ($str == false)
		{
			echo "\n";
			break;
		}
		$str = trim($str, "\n");
		if (is_numeric($str)) 
		{
			$nbr = (int)$str;
			if ($nbr % 2 == 0)
				echo "Le chiffre $str est Pair";
			else
				echo "Le chiffre $nbr est Impair";
		}
		else
			echo "'$str' n'est pas un chiffre";
		echo "\n";
	}
?>