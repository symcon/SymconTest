<?php

    class PropertyUpdateTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyString('Property1', 'Value');
            $this->RegisterPropertyString('Property2', 'Value');
        }
        
        public function UpdateValue($Field, $Value) {
            $this->UpdateFormField($Field, 'value', $Value);
        }
    }

?>
