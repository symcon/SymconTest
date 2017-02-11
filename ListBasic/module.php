<?

	class ListBasic extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("TreeData", "");

		}		
	
		public function GetConfigurationForm()
		{
			
			$data = json_decode(file_get_contents(__DIR__ . "/form.json"));
			
			//Only add default element if we do not have anything in persistence
			if($this->ReadPropertyString("TreeData") == "") {			
				$data->elements[0]->values[] = Array(
					"instanceID" => 12435,
					"name" => "ABCD",
					"state" => "OK!",
					"temperature" => 23.31,
					"rowColor" => "#ff0000"
				);
			} else {
				//Annotate existing elements
				$treeData = json_decode($this->ReadPropertyString("TreeData"));
				foreach($treeData as $treeRow) {
					//We only need to add annotations. Remaining data is merged from persistance automatically.
					//Order is determinted by the order of array elements
					if(IPS_ObjectExists($treeRow->instanceID)) {
						$data->elements[0]->values[] = Array(
							"name" => IPS_GetName($treeRow->instanceID),
							"state" => "OK!"
						);
					} else {
						$data->elements[0]->values[] = Array(
							"name" => "Not found!",
							"state" => "FAIL!"
						);
					}						
				}			
			}
			
			return json_encode($data);
		
		}	
	
	}

?>
