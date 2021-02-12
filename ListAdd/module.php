<?

	class ListAdd extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();

            $this->RegisterAttributeInteger('NewID', 1);

            $this->RegisterPropertyBoolean('DisplayID', false);
            $this->RegisterPropertyString('Targets', '[]');

		}
		public function ApplyChanges() {
			//Never delete this line!
            parent::ApplyChanges();
		}

		public function GetConfigurationForm() {
            $form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);
			$form['elements'][1]['columns'] = $this->generateColumns();
			return json_encode($form);
		}

		public function NewID($Targets) {
            $values = [];
			foreach ($Targets as $target) {
				if ($target['ID'] == 0) {
                    $target['ID'] = $this->generateIdentifier();
				}
                $values[] = $target;
			}
            $this->UpdateFormField('Targets', 'values', json_encode($values));
		}

		private function generateColumns() {
            $columns = [];
            if ($this->ReadPropertyBoolean('DisplayID')) {
                $columns[] = [
					'caption' => 'ID (Debug)',
					'name' => 'ID',
					'save' => true,
					'width' => '100px',
					'add' => 0
				];
            }
			$columns[] = [
				'caption' => 'Variable',
				'name' => 'VariableID',
				'add' => 0,
				'edit' => [
					'type' => 'SelectVariable'
				],
				'width' => 'auto'
			];
            return $columns;
		}

		public function generateIdentifier() {
			$newID = $this->ReadAttributeInteger('NewID');
			$this->WriteAttributeInteger('NewID', $newID + 1);
            return $newID;
			// return sprintf('{%04X%04X-%04X-%04X-%04X-%04X%04X%04X}', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

		}
		
	}

?>
