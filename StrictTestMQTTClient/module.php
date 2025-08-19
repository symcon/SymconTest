<?php

    class StrictTestMQTTClient extends IPSModuleStrict
    {
        public function Create(): void
        {
            //Never delete this line!
            parent::Create();
        }

        public function GetCompatibleParents(): string
        {
            return json_encode([
                'type' => 'connect',
                'moduleIDs' => [
                    // MQTT Server
                    '{C6D2AEB3-6E1F-4B2E-8E69-3A1A00246850}'
                    // MQTT Client
                    //'{F7A0DD2E-7684-95C0-64C2-D2A9DC47577B}'
                ]
            ]);
        }

        public function RequestAction(string $Ident, mixed $Value): void
        {
            SetValue($this->GetIDForIdent($Ident), $Value);
        }

        public function ReceiveData(string $JSONData): string
        {
            IPS_LogMessage("Data", $JSONData);

            return "";
        }

        public function Test(mixed $Test): void
        {
            echo $Test;
        }

        public function ActiveParentCheck() : bool
        {
            // Validating that the IPSModuleStrict stub can access protected methods
            return $this->HasActiveParent();
        }

        public function RegisterNewVariable() : bool {
            return $this->RegisterVariableBoolean('Ident', 'Booly');
        }
    }