<?php

abstract class House {

	public function house() {
		print("House " . $this->getHouseName() . " of " . 
			$this->getHouseSeat() . " : \"" . $this->getHouseMotto() . "\"" . PHP_EOL);
	}

	abstract function getHouseName();
	abstract function getHouseMotto();
	abstract function getHouseSeat();

}

?>