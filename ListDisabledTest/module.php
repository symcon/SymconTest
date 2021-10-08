<?php

    class ListDisabledTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();
            
            $this->RegisterPropertyString("TreeData", "");

        }

        public function SetEnabled($enabled) {
            $this->UpdateFormField('TreeData', 'enabled', $enabled);
        }
    
    }
