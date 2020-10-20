<?

	class SelectVariableTest extends IPSModule
	{
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
		}

		public function ChangeAction($action) {
			$this->UpdateFormField('dynamic', 'requiredAction', $action);
		}

		
		public function ChangeLogging($logging) {
			$this->UpdateFormField('dynamic', 'requiredLogging', $logging);
		}

		public function UpdateTypes($types) {
			$newTypes = [];
			for($i = 0; $i <count($types); $i++) {
				if ($types[$i]) {
					$newTypes[]= $i;
				}
			}
			$this->UpdateFormField('dynamic', 'validVariableTypes', json_encode($newTypes));
		}
	}
	
?>
