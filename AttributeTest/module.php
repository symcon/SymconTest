<?

	class AttributeTest extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
            $this->RegisterAttributeBoolean("BoolAttr", true);
            $this->RegisterAttributeInteger("IntAttr", 5);
			$this->RegisterAttributeFloat("FloatAttr", 3.7);
            $this->RegisterAttributeString("StrAttr", "lalala");
			
		}
		
		public function BumpAndShow() {
			
			var_dump($this->ReadAttributeBoolean("BoolAttr"));
            var_dump($this->ReadAttributeInteger("IntAttr"));
            var_dump($this->ReadAttributeFloat("FloatAttr"));
            var_dump($this->ReadAttributeString("StrAttr"));
            
            $this->WriteAttributeBoolean("BoolAttr", !$this->ReadAttributeBoolean("BoolAttr"));
			$this->WriteAttributeInteger("IntAttr", $this->ReadAttributeInteger("IntAttr")*2);
            $this->WriteAttributeFloat("FloatAttr", $this->ReadAttributeFloat("FloatAttr")+0.1);
            $this->WriteAttributeString("StrAttr", $this->ReadAttributeString("StrAttr") . "öäü");
            
		}
	}
	
?>
