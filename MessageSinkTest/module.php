<?

	define("IPS_BASE", 10000);
	define("IPS_INSTANCEMESSAGE", IPS_BASE + 500);
	define("IM_CHANGESTATUS", IPS_INSTANCEMESSAGE + 5);

	class MessageSinkTest extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyInteger("MonitorInstance", 0);

		}
		
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			if($this->ReadPropertyInteger("MonitorInstance") > 0) {
				$this->RegisterMessage($this->ReadPropertyInteger("MonitorInstance"), IM_CHANGESTATUS);
			}
			
		}
		
		public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
		{
			
			IPS_LogMessage("MessageSink", "New message!!!");
		
		}
		
	
	}

?>
