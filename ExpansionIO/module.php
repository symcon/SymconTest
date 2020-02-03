<?

	class ExpansionIO extends IPSModule
	{
        public function Create() {
            // Diese Zeile nicht löschen.
            parent::Create();
 
			$this->RegisterPropertyInteger('SomeSetting', 11);
		}
	}

?>
