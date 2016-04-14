<?php

class UnholyFactory {

	public static $fighters = array();

	public function absorb($type) {
		if ($type instanceof Fighter) {
			if (in_array($type->getFighter(), self::$fighters) === False)
			{
				printf("(Factory absorbed a fighter of type " . $type->getFighter() . ")" . PHP_EOL);
				array_push(self::$fighters, $type->getFighter());
			} else {
				printf("(Factory already absorbed a fighter of type " . $type->getFighter() . ")" . PHP_EOL);
			}
		}
		else
			printf("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
	}

	public function fabricate($rf) {
		foreach (self::$fighters as $fighter){
			if ($fighter === $rf) {
				print("(Factory fabricates a fighter of type " . $rf . ")" . PHP_EOL);
				$rf = str_replace(' ', '', $rf);
				$rf = ucfirst($rf);
				return new $rf;
			}
		}
		print("(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL);
		return;
	}

}

?>