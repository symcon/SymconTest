<?

	class WWWTest extends IPSModule
	{
		
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			//Connect to available splitter or create a new one
			$this->ConnectParent("{4CB91589-CE01-4700-906F-26320EFCF6C4}");
			
		}
		
		/**
		* This function will be available automatically after the module is imported with the module control.
		* Using the custom prefix this function will be callable from PHP and JSON-RPC through:
		*
		* WWWT_Get($id, $url);
		*
		*/
		public function Get($URL)
		{
			echo $this->SendDataToParent(json_encode(Array("DataID" => "{D4C1D08F-CD3B-494B-BE18-B36EF73B8F43}", "RequestMethod" => "GET", "RequestURL" => $URL, "RequestData" => "", "Timeout" => 10000)));
		}
		
		/**
		* The ReceiveData function is called then the timer in the www reader fires
		*
		*/		
		public function ReceiveData($JSONString)
		{
			$data = json_decode($JSONString);
			IPS_LogMessage("WWWTest", utf8_decode($data->Buffer));

			//Parse and write values to our variables
			
		}
		
	
	}

?>
