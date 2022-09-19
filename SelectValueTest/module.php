<?

    class SelectValueTest extends IPSModule
    {

        public function Create()
        {
            //Never delete this line!
            parent::Create();
            $this->RegisterVariableBoolean("SomeBool", "Some Boolean");
            $this->EnableAction("SomeBool");
            $this->RegisterVariableBoolean("SomeBoolProfile", "Some Boolean", '~Switch');
            $this->EnableAction("SomeBoolProfile");
            $this->RegisterVariableInteger("SomeEnumeration", "Some Enumeration", "~ShutterPosition.100");
            $this->EnableAction("SomeEnumeration");
            $this->RegisterVariableInteger("SomeDate", "Some Date", "~UnixTimestampDate");
            $this->EnableAction("SomeDate");
            $this->RegisterVariableInteger("SomeDateTime", "Some Date/Time", "~UnixTimestamp");
            $this->EnableAction("SomeDateTime");
            $this->RegisterVariableInteger("SomeTime", "Some Time", "~UnixTimestampTime");
            $this->EnableAction("SomeTime");
            $this->RegisterVariableInteger("SomeColor", "Some Color", "~HexColor");
            $this->EnableAction("SomeColor");
            $this->RegisterVariableInteger("SomePercentage", "Some Percentage", "~Intensity.100");
            $this->EnableAction("SomePercentage");
            $this->RegisterVariableFloat("SomeSuffix", "Some Suffix", "~Temperature");
            $this->EnableAction("SomeSuffix");
            $this->RegisterVariableFloat("SomeFloat", "Some Float");
            $this->EnableAction("SomeFloat");
            $this->RegisterVariableInteger("SomeInt", "Some Integer");
            $this->EnableAction("SomeInt");
            $this->RegisterVariableString("SomeString", "Some String");
            $this->EnableAction("SomeString");
        }


        public function RequestAction($Ident, $Value)
        {
            SetValue($this->GetIDForIdent($Ident), $Value);
        }

        public function UpdateVariableID($ID) {
            $this->UpdateFormField('SelectValue', 'variableID', $ID);
            $this->UpdateFormField('SelectValue2', 'variableID', $ID);
            $this->UpdateFormField('SelectValue3', 'variableID', $ID);
        }

        public function UpdateLabelValue($Value) {
            $this->UpdateFormField('ValueLabel', 'caption', $Value);
        }
    }
    
?>
