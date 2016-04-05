#!/usr/bin/php
<?php
	function ft_is_number($str)
	{
		$length = strlen($str);
		for ($i = 0; $i < $length - 1; $i++) {
			if ($str[$i] < '0' || $str[$i] > '9')
	    		return (0);
		}
		if ($i == 0)
			return (0);
		return (1);
	}

	$stdin = fopen("php://stdin","r");
	while (1)
	{
		echo "Entrez un nombre: ";
		$str = fgets($stdin);
		if ($str == false)
		{
			echo "\n";
			break;
		}
		$len = strlen($str);
		$ret = ft_is_number($str);
		$str[$len - 1] = '';
		if ($ret == 1) {
			$nbr = (int)$str;
			if ($nbr % 2 == 0) {
				echo "Le chiffre $str est Pair";
			} else {
				echo "Le chiffre $nbr est Impair";
			}
		}
		else
			echo "'$str' n'est pas un chiffre";
		echo "\n";
	}
?>