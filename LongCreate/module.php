<?php

    class LongCreate extends IPSModuleStrict
    {
        public function Create() : void
        {
            //Never delete this line!
            parent::Create();

            $this->RegisterAttributeBoolean('Created', false);

            IPS_Sleep(5000);

            $this->WriteAttributeBoolean('Created', true);
        }

        public function IsCreated() : bool
        {
            return $this->ReadAttributeBoolean('Created');
        }
    }
