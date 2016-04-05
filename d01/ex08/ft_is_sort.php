<?php
function ft_is_sort($array)
{
	$a = $array;
	$b = $array;
	sort($a);
	rsort($b);
	if ($array == $a || $array == $b)
		return (1);
	return (0);
}
?>