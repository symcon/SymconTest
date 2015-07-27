<?

	class HomeMaticOverride extends IPSModule
	{

		public function WriteValueBoolean($Parameter, $Value)
		{
			echo (int)$Value;
			IPS_LogMessage("", (String)$Value);
			
		}

	}

?>
