<?php

    class SelectIconTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyString('Icon', '');
        }

        public function SetIcon(string $Icon) {
            $this->UpdateFormField('Icon', 'value', $Icon);
        }
    }
