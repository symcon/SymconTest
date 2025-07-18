<?php

    class StrictTestPreferVirtualIO extends IPSModuleStrict
    {
        public function Create(): void
        {
            //Never delete this line!
            parent::Create();
        }

        public function GetCompatibleParents(): string
        {
            return json_encode([
                'moduleIDs' => ['{6179ED6A-FC31-413C-BB8E-1204150CF376}', '{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}']
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