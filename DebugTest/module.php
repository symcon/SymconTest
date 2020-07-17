<?

    class DebugTest extends IPSModule
    {

        public function Create() {
            parent::Create();

            $this->RegisterPropertyBoolean('AutoDebug', false);
            $this->RegisterTimer('AutoDebugTimer', 0, 'DT_MySendDebug($_IPS[\'TARGET\']);');
        }

        public function ApplyChanges() {
            parent::ApplyChanges();

            if ($this->ReadPropertyBoolean('AutoDebug')) {
                $this->SetTimerInterval('AutoDebugTimer', 5000);
            }
            else {
                $this->SetTimerInterval('AutoDebugTimer', 0);
            }
        }
        
        public function MySendDebug() {
            $this->SendDebug('Debug', 'Test this Debug!', 0);
        }

        public function ArrayInput(array $data) {
            
        }
    }
    
?>
