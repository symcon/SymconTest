<?

	class FunctionTest extends IPSModule
	{

		public function CallBoolean(bool $Value)
		{
			if($Value) {
				echo "True";
			} else {
				echo "False";
			}
		}

		public function CallInteger(int $Value) {
			echo $Value;
		}

		public function CallFloat(float $Value) {
			echo $Value;
		}

		public function CallString(string $Value) {
			echo $Value;
		}

	}

?>
