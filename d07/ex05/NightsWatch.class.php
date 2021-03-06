<?php

class NightsWatch {

	private $_fighters = array();

	public function recruit($fighter) {
		if ($fighter instanceof IFighter)
			array_push($this->_fighters, $fighter);
	}

	public function fight() {
		foreach ($this->_fighters as $fighter)
			$fighter->fight();
	}

}

?>