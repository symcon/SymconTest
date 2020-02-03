<?

	class ConfigurationForParentExpansionTest extends IPSModule
	{
        public function Create() {
            // Diese Zeile nicht löschen.
            parent::Create();
 
			$this->ForceParent("{0C7C84AA-494F-A12E-FD4F-D2D6431D6E3D}");
		}
		
		public function GetConfigurationForParent() {
			return json_encode([
				'SomeSetting' => 42
			]);
		}
	}

?>
