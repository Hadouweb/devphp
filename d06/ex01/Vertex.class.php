<?php

Class Vertex {

	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $_color;
	public static $verbose = False;

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }
	public function getColor() { return $this->_color; }

	public function setX( $x ) { $this->_x = floatval($x); }
	public function setY( $y ) { $this->_y = floatval($y); }
	public function setZ( $z ) { $this->_z = floatval($z); }
	public function setW( $w ) { $this->_w = floatval($w); }
	public function setColor( Color $color ) { $this->_color = $color; }

	public static function doc() {
		return file_get_contents('Vertex.doc.txt') . PHP_EOL;
	}

	public function __construct(array $kwargs) {
		if (array_key_exists('x', $kwargs))
			$this->setX($kwargs['x']);
		if (array_key_exists('y', $kwargs))
			$this->setY($kwargs['y']);
		if (array_key_exists('z', $kwargs))
			$this->setZ($kwargs['z']);
		if (array_key_exists('w', $kwargs))
			$this->setW($kwargs['w']);
		if (array_key_exists('color', $kwargs))
			$this->setColor($kwargs['color']);
		else
			$this->setColor(new Color(array('rgb' => 0xffffff)));
		if (self::$verbose === True)
            print("$this constructed" . PHP_EOL);
		return;
	}

	public function __destruct() {
		if (self::$verbose === True)
            printf("$this destructed" . PHP_EOL);
		return;
	}

	public function __toString() {
		if (self::$verbose === True)
			return (sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, $this->_color )",
				$this->_x, $this->_y, $this->_z, $this->_w));
		else
			return (sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w));
	}

}

?>