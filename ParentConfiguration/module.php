<?

	class ParentConfiguration extends IPSModule
	{
		
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			//Always create our own SerialPort, when no parent is already available
			$this->RequireParent("{6DC3D946-0D31-450F-A8C6-C42DB8D7D4F1}");
			
		}
		
		public function GetConfigurationForParent() {
			
			return "{\"BaudRate\": \"57600\", \"StopBits\": \"1\", \"DataBits\": \"8\", \"Parity\": \"None\"}";
			
		}
	
	}

?>
