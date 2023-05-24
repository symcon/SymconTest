<?php

//These constants are predefined with IP-Symcon 5.0+
if(!defined("IPS_BASE"))
	define("IPS_BASE", 10000);
if(!defined("IPS_INSTANCEMESSAGE"))
	define("IPS_INSTANCEMESSAGE", IPS_BASE + 500);
if(!defined("IM_CHANGESTATUS"))
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

		public function Dump() {

            return $this->GetMessageList();

		}
		
	
	}

?>
