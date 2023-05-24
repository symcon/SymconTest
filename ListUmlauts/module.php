<?php

	class ListUmlautsTest extends IPSModule
	{
		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("Umlauts", "[]");

		}

		public function UpdateValue() {
		   $newValue = json_encode([['text' => 'Würstchenßßäöü']]);
		   $oldValue = json_encode(json_decode($this->ReadPropertyString('Umlauts')));
		   $this->SendDebug('Umlauts' . '(prop)', $this->ReadPropertyString('Umlauts'), 0);
		   $this->SendDebug('Umlauts' . '(new)', $newValue, 0);
		
		   if ($newValue !== $oldValue){
			  echo "Neu und alt sind ungleich". PHP_EOL;
			  $this->UpdateFormField('Umlauts', 'values', $newValue);
		   } else {
			  echo "Neu und alt sind gleich". PHP_EOL;
		   }
		}
	}

?>
