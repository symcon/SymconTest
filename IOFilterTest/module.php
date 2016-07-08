<?

	class IOFilterTest extends IPSModule
	{

		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("ReceiveFilter", ".*Hallo.*");

		}
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			//Connect to available splitter or create a new one
			$this->ConnectParent("{6179ED6A-FC31-413C-BB8E-1204150CF376}");
			
			//Apply filter
			$this->SetReceiveDataFilter($this->ReadPropertyString("ReceiveFilter"));
			
		}
		
		public function ReceiveData($JSONString)
		{
			$data = json_decode($JSONString);

			//Parse and write values to our buffer
			$this->SetBuffer("Test", utf8_decode($data->Buffer));

			//Print buffer
			IPS_LogMessage("IOTest", $this->GetBuffer("Test"));
			
		}
		
	
	}

?>
