<?php

    class ListAddStrategyTest extends IPSModule
    {

        public function Create()
        {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyString('Entries', '[]');
        }

        public function ApplyChanges()
        {
            //Never delete this line!
            parent::ApplyChanges();
        }

        public function ShowAdded($Entries)
        {
            echo sprintf(
                "Added entry:\nID:    %s\nToken: %s\nDice:  %s\nGUID:  %s",
                $Entries['ID'],
                $Entries['Token'],
                $Entries['Dice'],
                $Entries['GUID']
            );
        }

        public function GetEntries()
        {
            $entries = json_decode($this->ReadPropertyString('Entries'), true);
            if (count($entries) === 0) {
                return 'No entries saved yet. Add entries and apply the configuration first.';
            }

            $lines = [];
            foreach ($entries as $entry) {
                $lines[] = sprintf('%-4s | %-16s | %s | %s', $entry['ID'], $entry['Token'], $entry['Dice'], $entry['GUID']);
            }
            return implode("\n", $lines);
        }
    }
