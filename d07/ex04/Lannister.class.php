<?php

class Lannister {

	public function sleepWith($instance) {
		if (get_class($instance) === "Tyrion" || get_class($instance) === "Jaime")
			print("Not even if I'm drunk !" . PHP_EOL);
		else if (get_class($instance) === "Sansa")
			print("Let's do this." . PHP_EOL);
	}
}

?>