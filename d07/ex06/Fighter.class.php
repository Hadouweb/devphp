<?php

abstract class Fighter {

	private $fighterType;

	public function getFighter() {
		return $this->fighterType;
	}

	public function __construct($type) {
		$this->fighterType = $type;
	}

	abstract function fight($target);

}

?>