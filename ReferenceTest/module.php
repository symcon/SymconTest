<?php

    class ReferenceTest extends IPSModule
    {
        
        public function ApplyChanges() {

            $refs = $this->GetReferenceList();
            foreach($refs as $ref) {
                $this->UnregisterReference($ref);
            }
            $ids = IPS_GetInstanceListByModuleID("{43192F0B-135B-4CE7-A0A7-1475603F3060}");
            foreach($ids as $id) {
                $this->RegisterReference($id);
            }
            
        }
    }
    
?>
