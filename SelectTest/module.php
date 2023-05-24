<?php

	class SelectTest extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();

			$this->RegisterPropertyInteger("ColorProp", -1);
            $this->RegisterPropertyString("LocationProp", "");
            $this->RegisterPropertyString("ActionProp", "");
			
		}

		public function ChangeProfileType($profileType) {
			$this->UpdateFormField('ProfileDynamic', 'profileType', $profileType);
		}

		public function ChangeValidModule($guid) {
			$this->UpdateFormField('InstanceDynamic', 'validModules', json_encode([$guid]));
		}

		public function ChangeModule($guid)
		{
			$this->UpdateFormField('SelectModuleData', 'moduleID', $guid);
		}
	}
	
?>
