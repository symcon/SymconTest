<?

    class MultilineTest extends IPSModule
    {
        public function Create() {
            parent::Create();

            $this->RegisterPropertyString('Text', '');
            $this->RegisterPropertyString('Password', '');
        }

        public function UpdateMultiline(bool $multiline) {
            $this->UpdateFormField('Text', 'multiline', $multiline);
        }
    }
    
?>
