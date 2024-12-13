<?php

    if (!defined('PRESENTATION_ENUMERATION')) {
        define('PRESENTATION_ENUMERATION', '{52D9E126-D7D2-2CBB-5E62-4CF7BA7C5D82}');
    }

    class PresentationTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();
            
            $this->RegisterVariableBoolean('Bool', 'Bool', ['PRESENTATION' => PRESENTATION_ENUMERATION]);
            $this->RegisterVariableBoolean('Int', 'Int', ['PRESENTATION' => PRESENTATION_ENUMERATION]);
            $this->RegisterVariableBoolean('Float', 'Float', ['PRESENTATION' => PRESENTATION_ENUMERATION]);
            $this->RegisterVariableBoolean('String', 'String', ['PRESENTATION' => PRESENTATION_ENUMERATION]);

            $this->EnableAction('Bool');
            $this->EnableAction('Int');
            $this->EnableAction('Float');
            $this->EnableAction('String');
        }
    }