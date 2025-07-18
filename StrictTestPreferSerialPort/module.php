<?php

    class StrictTestPreferSerialPort extends IPSModuleStrict
    {
        public function Create(): void
        {
            //Never delete this line!
            parent::Create();
        }

        public function GetCompatibleParents(): string
        {
            return json_encode([
                'moduleIDs' => ['{6DC3D946-0D31-450F-A8C6-C42DB8D7D4F1}', '{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}']
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