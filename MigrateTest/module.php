<?php

    class MigrateTest extends IPSModule
    {

        public function Create() {
            parent::Create();
            IPS_LogMessage("CREATE", $this->InstanceID);

            $this->RegisterPropertyString("TestP", "START_P");
            $this->RegisterAttributeString("TestA", "START_A");

            $this->RegisterPropertyString("MigratedP", "");
            $this->RegisterAttributeString("MigratedA", "");
        }

        public function Destroy() {
            parent::Destroy();
            IPS_LogMessage("DESTROY", $this->InstanceID);
        }

        public function Migrate($JSONString) {
            parent::Migrate($JSONString);
            IPS_LogMessage("MIGRATE", $JSONString);

            $j = json_decode($JSONString);
            $j->configuration->MigratedP = $j->configuration->TestP;
            $j->attributes->MigratedA = $j->attributes->TestA;
            $JSONString = json_encode($j);

            return $JSONString;
        }

        public function ApplyChanges() {
            parent::ApplyChanges();
            IPS_LogMessage("APPLYCHANGES", $this->InstanceID);

            IPS_LogMessage("MigratedP", $this->ReadPropertyString("MigratedP"));
            IPS_LogMessage("MigratedA", $this->ReadAttributeString("MigratedA"));
        }
    }
    
?>
