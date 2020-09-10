<?

	class SelectTest extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();

			$this->RegisterPropertyInteger("ColorProp", -1);
            $this->RegisterPropertyString("LocationProp", "");
			
		}

		public function ChangeProfileType($profileType) {
			$this->UpdateFormField('ProfileDynamic', 'profileType', $profileType);
		}
<<<<<<< HEAD

		public function ChangeValidModule($guid) {
			$this->UpdateFormField('InstanceDynamic', 'validModules', json_encode([$guid]));
		}
=======
>>>>>>> 7293d7ff201f26a4cce736471856f04deb23fed0
	}
	
?>
