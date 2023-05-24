<?php

	class ListAction extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("FileData", "");

		}	
		
		public function GetConfigurationForm()
		{
			
			$data = json_decode(file_get_contents(__DIR__ . "/form.json"));
			
			if($this->ReadPropertyString("FileData") != "") {
				
				$lines = preg_split("/\\r\\n|\\r|\\n/", base64_decode($this->ReadPropertyString("FileData")));
				$csv = array_map('str_getcsv', $lines);
				
				if(sizeof($csv) > 0) {
					
					$header = array_shift($csv);
										
					foreach($header as $col) {
						$data->actions[0]->columns[] = Array("name" => $col, "label" => $col, "width" => round(480 / sizeof($header)) . "px");
					}

					array_walk($csv, function(&$item) use ($header) {
						$item = array_combine($header, $item);
					}, $header);
										
					foreach($csv as $row) {
						$data->actions[0]->values[] = $row;
					}
					
				}
				
			}
			
			return json_encode($data);
		
		}
		
	}

?>
