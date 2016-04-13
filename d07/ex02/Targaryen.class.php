<?php

class Targaryen {

	public function resistsFire() {
		return False;
	}

	public function getBurned() {
		if ($this->resistsFire() === True)
			return 'Daenerys emerges naked but unharmed';
		else
			return 'Viserys burns alive';
	}

}

?>