<?php

    class DestroyTest extends IPSModule
    {

        public function Create() {
            parent::Create();
            IPS_LogMessage("CREATE", $this->InstanceID);
        }

        public function Destroy() {
            parent::Destroy();
            IPS_LogMessage("DESTROY", $this->InstanceID);
        }

        public function ApplyChanges() {
            parent::ApplyChanges();
            IPS_LogMessage("APPLYCHANGES", $this->InstanceID);
        }
    }
    
?>
