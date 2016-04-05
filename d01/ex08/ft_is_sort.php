<?php
function ft_is_sort($array)
{
	$a = $array;
	$b = $array;
	sort($b);
	if ($a == $b)
		return (1);
	return (0);
}
?>