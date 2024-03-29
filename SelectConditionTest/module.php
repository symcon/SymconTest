<?php

    class SelectConditionTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyString("Condition", "");
            $this->RegisterPropertyString("ConditionMulti", "");
            $this->RegisterPropertyString("ConditionC", "");
            $this->RegisterPropertyString("ConditionMultiC", "");
        }

        public function ChangeParameter($field, $name, $value) {
            $this->SendDebug($field, $name .': '. $value, 0);
            $this->UpdateFormField($field, $name, $value);
        }
    }
