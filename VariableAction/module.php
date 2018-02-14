<?

	class VariableAction extends IPSModule
	{
		
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			//Lets register a variable with action
			$this->RegisterVariableInteger("TestVariable", "Test", "~Intensity.100");
			$this->EnableAction("TestVariable");
			
		}
		
		public function RequestAction($Ident, $Value)
		{
			
			switch($Ident) {
				case "TestVariable":
					$this->SetValue($Ident, $Value);
					break;
				default:
					throw new Exception("Invalid ident");
			}
		
		}
		
		//Add this Polyfill for IP-Symcon 4.4 and older
		protected function SetValue($Ident, $Value) {
			
			if(IPS_GetKernelVersion() >= 5) {
				parent::SetValue($Ident, $Value);
			} else {
				SetValue($this->GetIDForIdent($Ident), $Value);
			}
			
		}
		
	
	}

?>
