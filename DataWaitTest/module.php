<?

	class DataWaitTest extends IPSModule
	{
		public function Create() {
		 
			// Diese Zeile nicht entfernen
			parent::Create();
		 
			// Erstellt einen Timer mit dem Namen "Update" und einem Intervall von 5 Sekunden. 
			$this->RegisterTimer("SendData", 5000, "DWT_Send(\$_IPS['TARGET']);");
		}

		public function Send() {
			$this->NotifyWithData("SuperName", "Cool, es geht!", false);
		}
		
		public function Wait() {
			return $this->WaitForData("SuperName", 10000);
		}
	}
	
?>
