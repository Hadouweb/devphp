<?php

Class Color {

	public $red = 0;
	public $blue = 0;
	public $green = 0;
	public static $verbose = False;

	public function getRed() { return $this->red; }
	public function getBlue() { return $this->blue; }
	public function getGreen() { return $this->green; }

	public static function doc() {
		return file_get_contents('Color.doc.txt') . PHP_EOL;
	}

	public function add(Color $color) {
		$color = new Color(array(
			'red' => $this->red + $color->red,
			'blue' => $this->blue + $color->blue,
			'green' => $this->green + $color->green)); 
		return $color;
	}

	public function sub(Color $color) {
		$color = new Color(array(
			'red' => $this->red - $color->red,
			'blue' => $this->blue - $color->blue,
			'green' => $this->green - $color->green)); 
		return $color;
	}

	public function mult($f) {
		$color = new Color(array(
			'red' => $this->red * $f,
			'blue' => $this->blue * $f,
			'green' => $this->green * $f)); 
		return $color;
	}

	public function __construct(array $kwargs) {
		if (array_key_exists('rgb', $kwargs))
		{
			$this->red = intval(($kwargs['rgb'] >> 16) & 0xff);
			$this->green = intval(($kwargs['rgb'] >> 8) & 0xff);
			$this->blue = intval(($kwargs['rgb']) & 0xff);
		}
		else {	
			if (array_key_exists('red', $kwargs))
				$this->red = intval($kwargs['red']);
			if (array_key_exists('green', $kwargs))
				$this->green = intval($kwargs['green']);
			if (array_key_exists('blue', $kwargs))
				$this->blue = intval($kwargs['blue']);
		}
		if (self::$verbose === True)
            print("$this constructed." . PHP_EOL);
		return;
	}

	public function __destruct() {
		if (self::$verbose === True)
            printf("$this destructed." . PHP_EOL);
		return;
	}

	public function __toString() {
		return sprintf("Color( red: %3.3s, green: %3.3s, blue: %3.3s )", $this->red, $this->green, $this->blue);
	}

}

?>