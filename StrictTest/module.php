<?php

    class StrictTest extends IPSModuleStrict
    {
        public function Create(): void
        {
            //Never delete this line!
            parent::Create();
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
    }