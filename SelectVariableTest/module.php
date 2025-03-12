<?php

    class SelectVariableTest extends IPSModule
    {
        public function Create()
        {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyInteger('SelectIntegerFloat', 0);
            $this->RegisterPropertyInteger('SelectDynamic', 0);
        }

        public function ChangeAction($action)
        {
            $this->UpdateFormField('SelectDynamic', 'requiredAction', $action);
        }

        
        public function ChangeLogging($logging)
        {
            $this->UpdateFormField('SelectDynamic', 'requiredLogging', $logging);
        }

        public function UpdateTypes($types)
        {
            $newTypes = [];
            for ($i = 0; $i <count($types); $i++) {
                if ($types[$i]) {
                    $newTypes[]= $i;
                }
            }
            $this->UpdateFormField('SelectDynamic', 'validVariableTypes', json_encode($newTypes));
        }

        public function UpdatePresentations($presentations)
        {
            $supportedPresentations = [
                VARIABLE_PRESENTATION_VALUE_INPUT,
                VARIABLE_PRESENTATION_LEGACY,
                VARIABLE_PRESENTATION_ENUMERATION
            ];
            $newPresentations = [];
            for ($i = 0; $i <count($presentations); $i++) {
                if ($presentations[$i]) {
                    $newPresentations[]= $supportedPresentations[$i];
                }
            }
            $this->UpdateFormField('SelectDynamic', 'validPresentations', json_encode($newPresentations));
        }
    }
