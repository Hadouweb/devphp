<?php

Class Vector {

	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;
	public static $verbose = False;

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }

	public static function doc() {
		return file_get_contents('Vector.doc.txt') . PHP_EOL;
	}

	public function __construct(array $kwargs) {
		if (array_key_exists('dest', $kwargs))
			//$this->setX($kwargs['dest']);
		else
			return False;
		if (array_key_exists('orig', $kwargs))
			//$this->setX($kwargs['dest']);
		else
		{
			$this->_x = 0.0;
			$this->_x = 0.0;
			$this->_x = 0.0;
			$this->_x = 1.0;
		}
		if (self::$verbose === True)
			print("$this constructed" . PHP_EOL);
		return;
	}

	public function __destruct() {
		if (self::$verbose === True)
			print("$this constructed" . PHP_EOL);
		return;
	}

	public function __toString() {
		if (self::$verbose === True)
			return (sprintf("Vector( x: %.2f, y: %.2f, z:%.2f, w:%.2f, $this->_color )",
				$this->_x, $this->_y, $this->_z, $this->_w));
		else
			return (sprintf("Vector( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w));
	}

}

?>