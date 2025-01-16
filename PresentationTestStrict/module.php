<?php

    if (!defined('PRESENTATION_ENUMERATION')) {
        define('PRESENTATION_ENUMERATION', '{52D9E126-D7D2-2CBB-5E62-4CF7BA7C5D82}');
    }

    class PresentationTestStrict extends IPSModuleStrict
    {

        public function Create(): void {
            //Never delete this line!
            parent::Create();

            $this->RegisterVariableBoolean('Bool', 'Bool', ['PRESENTATION' => PRESENTATION_ENUMERATION]);
            $this->RegisterVariableInteger('Int', 'Int', ['PRESENTATION' => PRESENTATION_ENUMERATION]);
            $this->RegisterVariableFloat('Float', 'Float', ['PRESENTATION' => PRESENTATION_ENUMERATION]);
            $this->RegisterVariableString('String', 'String', ['PRESENTATION' => PRESENTATION_ENUMERATION]);

            $this->EnableAction('Bool');
            $this->EnableAction('Int');
            $this->EnableAction('Float');
            $this->EnableAction('String');
        }
    }