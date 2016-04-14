<?php

abstract class Fighter {

	private $_fighterType;

	public function getFighter() {
		return $this->_fighterType;
	}

	public function __construct($type) {
		$this->_fighterType = $type;
	}

	abstract function fight($target);

}

?>