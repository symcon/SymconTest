<?php

    class ExpansionPanelUpdateTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyInteger('Number', 5);
            $this->RegisterPropertyString('List', '[{"Name":"Entry 1","Value":1},{"Name":"Entry 2","Value":2}]');
        }

        public function UpdateNumber(float $Value) {
            $this->UpdateFormField('Number', 'value', $Value);
        }

        public function UpdateList(string $Values) {
            $this->UpdateFormField('List', 'values', $Values);
        }

        public function UpdateListRandom() {
            $values = [];
            for ($i = 1; $i <= 3; $i++) {
                $values[] = [
                    'Name' => 'Updated ' . $i,
                    'Value' => rand(0, 100)
                ];
            }
            $this->UpdateFormField('List', 'values', json_encode($values));
        }
    }

?>
