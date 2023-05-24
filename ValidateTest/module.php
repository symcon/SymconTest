<?php

    class ValidateTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyString('DynamicTextBox', '');
        }

        public function UpdateParameter($name, $parameter, $value) {
            $this->UpdateFormField($name, $parameter, $value);
        }
    }

?>
