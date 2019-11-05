<?

	class ListUmlautsTest extends IPSModule
	{
		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("Umlauts", "[]");

		}

		public function UpdateValue() {
			$this->UpdateFormField('Umlauts', 'values', json_encode([['text' => 'Würstchenßßäöü']]));
		}
	}

?>
