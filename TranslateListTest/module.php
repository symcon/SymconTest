<?php

	class TranslateListTest extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("TranslateList", "[]");
			$this->RegisterPropertyString("TranslateTree", "[]");

		}
	
	}

?>
