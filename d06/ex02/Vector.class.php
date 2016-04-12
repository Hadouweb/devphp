<?php

//require_once 'Vertex.class.php';

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

	public function magnitude() {
		$ret = sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z));
		return (floatval($ret));
	}

	public function normalize() {
		$len = $this->magnitude();
		$vertex = new Vertex(array(
			'x' => $this->getX() / $len, 
			'y' => $this->getY() / $len, 
			'z' => $this->getZ() / $len));
		$ret = new Vector(array('dest' => $vertex));
		return $ret;
	}

	public function add(Vector $rhs) {
		$vertex = new Vertex(array(
			'x' => $this->getX() + $rhs->getX(), 
			'y' => $this->getY() + $rhs->getY(), 
			'z' => $this->getZ() + $rhs->getZ()));
		$ret = new Vector(array('dest' => $vertex));
		return $ret;
	}

	public function sub(Vector $rhs) {
		$vertex = new Vertex(array(
			'x' => $this->getX() - $rhs->getX(), 
			'y' => $this->getY() - $rhs->getY(), 
			'z' => $this->getZ() - $rhs->getZ()));
		$ret = new Vector(array('dest' => $vertex));
		return $ret;
	}

	public function opposite() {
		$vertex = new Vertex(array(
			'x' => -$this->getX(), 
			'y' => -$this->getY(), 
			'z' => -$this->getZ()));
		$ret = new Vector(array('dest' => $vertex));
		return $ret;
	}

	public static function doc() {
		return file_get_contents('Vector.doc.txt') . PHP_EOL;
	}

	public function __construct(array $kwargs) {
		if (array_key_exists('dest', $kwargs))
		{
			if (is_a($kwargs['dest'], 'Vertex') === False)
				die("Error: kwargs['dest'] is not an instance of vertex class" . PHP_EOL);
			$dest = $kwargs['dest'];
		}
		else
			die("Error: no value for kwargs['dest']" . PHP_EOL);
		if (array_key_exists('orig', $kwargs))
		{
			if (is_a($kwargs['orig'], 'Vertex') === False)
				die("Error: kwargs['orig'] is not an instance of vertex class" . PHP_EOL);
			$orig = $kwargs['orig'];
		}
		else
			$orig = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0));
		$this->_x = $dest->getX() - $orig->getX();
		$this->_y = $dest->getY() - $orig->getY();
		$this->_z = $dest->getZ() - $orig->getZ();
		$this->_w = $dest->getW() - $orig->getW();
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
			return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w));
		else
			return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w));
	}

}

?>