<?php

    class TestCenterTest extends IPSModule
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
            if (!IPS_VariableProfileExists('Test.SingleEnum')) {
                IPS_CreateVariableProfile('Test.SingleEnum', 1);
                IPS_SetVariableProfileAssociation('Test.SingleEnum', 0, 'TestEnum', '', -1);
            }            
            $this->RegisterVariableInteger("SingleEnumeration", "SingleEnumeration", "Test.SingleEnum");
            $this->EnableAction("SingleEnumeration");
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
    }
    
?>
