<?

	class DynamicConfigurationForm extends IPSModule
	{
		
		public function GetConfigurationForm()
		{
			
			return '{ "actions": [ { "type": "Label", "label": "The current time is '.date("d.m.y H:i").'" } ] }';
		
		}
		
	
	}

?>
