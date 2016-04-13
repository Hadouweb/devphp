<?php

class Jaime extends Lannister {

	public function sleepWith($instance) {
		parent::sleepWith($instance);
		if (get_class($instance) === "Cersei")
			print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
	}

}

?>