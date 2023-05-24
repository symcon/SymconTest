<?php

	class TranslateTest extends IPSModule
	{
		
		public function GetConfigurationForm()
		{
			
			$data = json_decode(file_get_contents(__DIR__ . "/form.json"));
			$data->actions[0]->label = sprintf($this->Translate("The current time is %s"), date("d.m.y H:i"));
			return json_encode($data);
		}
		
	
	}

?>
