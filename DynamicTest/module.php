<?php

    class DynamicTest extends IPSModule
    {
        public function Create() {
            parent::Create();
            
            $this->RegisterVariableBoolean("ActionVariable", "Action Variable", "~Switch", 0);
            $this->EnableAction("ActionVariable");
        }
        
        public function RequestAction($Ident, $Value) {
            SetValue($this->GetIDForIdent($Ident), $Value);
        }
        
        public function UpdateParameter($Field, $Parameter, $Value) {
            $this->UpdateFormField($Field, $Parameter, $Value);
        }

        public function SetInvalid() {
            $this->UpdateFormField('Label', 'caption', 'invalid'); // nicht ok
        }
        
        public function Reload() {
            $this->ReloadForm();
        }
    }
    
?>
