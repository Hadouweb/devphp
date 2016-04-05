#!/usr/bin/php
<?php
	if ($argc >= 2)
	{
		$tabs = explode(" ", trim($argv[1]));
		array_map('trim', $tabs);
		$tabs = array_filter($tabs);
		if (empty($tabs[0]))
			echo $argv[1]."\n";
		else
		{
			foreach ($tabs as $key => $value)
			{
				if ($key != 0)
					echo $value." ";
			}
			echo $tabs[0]."\n";
		}
	}
?>