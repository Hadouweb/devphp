<?php

class House {

	public function house() {
		print("House " . $this->getHouseName() . " of " . 
			$this->getHouseSeat() . " : \"" . $this->getHouseMotto() . "\"" . PHP_EOL);
	}

}

?>