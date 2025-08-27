<?

    class SaveExpandTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

        }

        public function UpdateValues($treeValues, $name, $expand) {
            $values = [];
            foreach ($treeValues as $value) {
                $values[] = $value;
            }

            if ($values[0]['name'] === 'Category 1') {
                $values[0]['name'] = 'Category 2';
                $values[1]['name'] = 'Test 2';
            }
            else {
                $values[0]['name'] = 'Category 1';
                $values[1]['name'] = 'Test 1';
            }

            if ($expand === -1) {
                $values[0]['expanded'] = false;
            }
            else if ($expand === 1) {
                $values[0]['expanded'] = true;
            }

            $this->UpdateFormField($name, 'values', json_encode($values));
        }
    }

?>
