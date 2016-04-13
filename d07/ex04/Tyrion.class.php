<?php

class Tyrion extends Lannister {

	public function sleepWith($instance) {
		parent::sleepWith($instance);
		if (get_class($instance) === "Cersei")
			print("Not even if I'm drunk !" . PHP_EOL);
	}

}

?>