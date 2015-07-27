<?

	class IOTest extends IPSModule
	{
		
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			//Connect to available splitter or create a new one
			$this->ConnectParent("{46C969BF-3465-4E3E-B2A5-E404FB969735}");
			
		}
		
		/**
		* This function will be available automatically after the module is imported with the module control.
		* Using the custom prefix this function will be callable from PHP and JSON-RPC through:
		*
		* IOT_Send($id, $text);
		*
		*/
		public function Send($Text)
		{
			$this->SendDataToParent(json_encode(Array("DataID" => "{B87AC955-F258-468B-92FE-F4E0866A9E18}", "Buffer" => $Text)));
		}
		
		public function ReceiveData($JSONString)
		{
			$data = json_decode($JSONString);
			IPS_LogMessage("IOTest", utf8_decode($data->Buffer));

			//Parse and write values to our variables
			
		}
		
	
	}

?>
