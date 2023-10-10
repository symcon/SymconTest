<?php

    class OnChangeDelayTest extends IPSModule
    {
        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterVariableInteger('Test', 'Test', '~Humidity', 0);
        }

        public function setID() {
            $this->UpdateFormField('SelectValue', 'variableID', $this->GetIDForIdent('Test'));
        }
    }
