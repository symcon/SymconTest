<?

	class FileDialog extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("FileData", "");

		}

		public function GetConfigurationForm()
		{
			
			$data = json_decode(file_get_contents(__DIR__ . "/form.json"));
			
			//if we have file data available lets show something...
			$data->actions[0]->label = substr(base64_decode($this->ReadPropertyString("FileData")), 0, 64);

			return json_encode($data);
		
		}
		
	
	}

?>
