<?PHP

require_once 'Vector.class.php';

Class Matrix {

	const IDENTITY = 'IDENTITY';
	const SCALE = 'SCALE preset'; 
	const RX = 'Ox ROTATION preset';
	const RY = 'Oy ROTATION preset';
	const RZ = 'Oz ROTATION preset';
	const TRANSLATION = 'TRANSLATION preset';
	const PROJECTION = 'PROJECTION preset';
	public static $verbose = False;

	private $_matrix = array(
		array(1.0, 0.0, 0.0, 0.0), 
		array(0.0, 1.0, 0.0, 0.0), 
		array(0.0, 0.0, 1.0, 0.0), 
		array(0.0, 0.0, 0.0, 1.0) );

	public static function doc() {
		print (file_get_contents("./Matrix.doc.txt") . PHP_EOL);
		return;
	}

	public function mult($rhs) {
		$v = Matrix::$verbose;
		Matrix::$verbose = False;
		$result = new Matrix( ['preset' => Matrix::IDENTITY] );
		Matrix::$verbose = $v;
		for ( $i = 0; $i < 4; $i++ ) {
			for ( $j = 0; $j < 4; $j++ )
			{
				$result->_matrix[$i][$j] = 
				$this->_matrix[$i][0] * $rhs->_matrix[0][$j] + 
				$this->_matrix[$i][1] * $rhs->_matrix[1][$j] + 
				$this->_matrix[$i][2] * $rhs->_matrix[2][$j] + 
				$this->_matrix[$i][3] * $rhs->_matrix[3][$j];
			}
		}
		return ( $result );
	}
	
	public function transformVertex(Vertex $vtx) {
		$x = $vtx->getX() * $this->_matrix[0][0] + $vtx->getY() * $this->_matrix[0][1] + $vtx->getZ() * $this->_matrix[0][2] + $this->_matrix[0][3];
		$y = $vtx->getX() * $this->_matrix[1][0] + $vtx->getY() * $this->_matrix[1][1] + $vtx->getZ() * $this->_matrix[1][2] + $this->_matrix[1][3];
		$z = $vtx->getX() * $this->_matrix[2][0] + $vtx->getY() * $this->_matrix[2][1] + $vtx->getZ() * $this->_matrix[2][2] + $this->_matrix[2][3];
		$w = $vtx->getX() * $this->_matrix[3][0] + $vtx->getY() * $this->_matrix[3][1] + $vtx->getZ() * $this->_matrix[3][2] + $this->_matrix[3][3];
		if (intval($w) !== 0)
			return (new Vertex(['x' => $x / $w, 'y' => $y / $w, 'z' => $z / $w]));
		else
			return (new Vertex(['x' => $x, 'y' => $y, 'z' => $z]));
	}

	private function _setScaleMatrix($scale) {
		$this->_matrix[0][0] = floatval($scale);
		$this->_matrix[1][1] = floatval($scale);
		$this->_matrix[2][2] = floatval($scale);
	}

	private function _setRXmatrix($angle) {
		$this->_matrix[1][1] = cos($angle);
		$this->_matrix[1][2] = -sin($angle);
		$this->_matrix[2][1] = sin($angle);
		$this->_matrix[2][2] = cos($angle);
	}

	private function _setRYmatrix($angle) {
		$this->_matrix[0][0] = cos($angle);
		$this->_matrix[0][2] = sin($angle);
		$this->_matrix[2][0] = -sin($angle);
		$this->_matrix[2][2] = cos($angle);
	}

	private function _setRZmatrix($angle) {
		$this->_matrix[0][0] = cos($angle);
		$this->_matrix[0][1] = -sin($angle);
		$this->_matrix[1][0] = sin($angle);
		$this->_matrix[1][1] = cos($angle);
	}

	private function _setTranslationMatrix(Vector $vector) {
		$this->_matrix[0][3] += $vector->getX();
		$this->_matrix[1][3] += $vector->getY();
		$this->_matrix[2][3] += $vector->getZ();
	}

	private function _setProjectionMatrix($fov, $near, $far, $ratio) {
		$tanHalfFOV = tan(deg2rad($fov) / 2.0);
		$range = $near - $far;
		$this->_matrix[0][0] /= ($tanHalfFOV * $ratio);
		$this->_matrix[1][1] /= $tanHalfFOV;
		$this->_matrix[2][2] = -((-$near - $far) / $range);
		$this->_matrix[2][3] = (2.0 * $far * $near / $range);
		$this->_matrix[3][2] = -1.0;
		$this->_matrix[3][3] = 0.0;
	}

	public function __construct(array $kwargs) {
		if (array_key_exists('preset', $kwargs)) {
			if (self::$verbose === True)
				print('Matrix ' . $kwargs['preset'] . ' instance constructed' . PHP_EOL);
			if ($kwargs['preset'] === self::IDENTITY)
				return;
			if ($kwargs['preset'] === self::SCALE) {	
				if (array_key_exists('scale', $kwargs))
					$this->_setScaleMatrix($scale = $kwargs['scale']);
				else
					die("Error: no value for kwargs['scale']" . PHP_EOL);
			}
			if ($kwargs['preset'] === self::RX) { 
				if (array_key_exists('angle', $kwargs))
					$this->_setRXmatrix($kwargs['angle']);
				else
					die("Error: no value for kwargs['angle']" . PHP_EOL);
			}
			if ($kwargs['preset'] === self::RY) { 
				if (array_key_exists('angle', $kwargs))
					$this->_setRYmatrix($kwargs['angle']);
				else
					die("Error: no value for kwargs['angle']" . PHP_EOL);
			}
			if ($kwargs['preset'] === self::RZ) { 
				if (array_key_exists('angle', $kwargs))
					$this->_setRZmatrix($kwargs['angle']);
				else
					die("Error: no value for kwargs['angle']" . PHP_EOL);
			}
			if ($kwargs['preset'] === self::TRANSLATION) { 
				if (array_key_exists('vtc', $kwargs))
					$this->_setTranslationMatrix($kwargs['vtc']);
				else
					die("Error: no value for kwargs['vtc']" . PHP_EOL);
			}
			if ( $kwargs['preset'] === self::PROJECTION) {
				if (array_key_exists('fov', $kwargs) && array_key_exists('ratio', $kwargs) && 
					array_key_exists('near', $kwargs) && array_key_exists('far', $kwargs))
					$this->_setProjectionMatrix(floatval($kwargs['fov']), floatval($kwargs['near']),
						floatval($kwargs['far']), floatval($kwargs['ratio']));
				else
					die("Error: no value for kwargs['fov'] or kwargs['ratio'] or kwargs['near'] or kwargs['far']" . PHP_EOL);
			}
		}
		else
			die("Error: no value for kwargs['preset']" . PHP_EOL);
		return;
	}

	public function __destruct() {
		if ( self::$verbose === True )
			print('Matrix instance destructed' . PHP_EOL);
		return;
	}

	public function __toString() {
		return (sprintf('M | vtcX | vtcY | vtcZ | vtxO' . PHP_EOL . '-----------------------------'
		. PHP_EOL . 'x | %.2f | %.2f | %.2f | %.2f' . PHP_EOL . 'y | %.2f | %.2f | %.2f | %.2f'
		. PHP_EOL . 'z | %.2f | %.2f | %.2f | %.2f' . PHP_EOL . 'w | %.2f | %.2f | %.2f | %.2f', 
		$this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3], 
		$this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3], 
		$this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3], 
		$this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3] ) );
	}
}
?>