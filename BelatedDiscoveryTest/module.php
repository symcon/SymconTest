<?

    class BelatedDiscoveryTest extends IPSModule
    {
        public function Create() {
            parent::Create();
            
            $this->RegisterTimer('LoadDevicesTimer', 0, 'BDT_LoadDevices($_IPS["TARGET"]);');
        }

        public function GetConfigurationForm() {
            if ($this->GetBuffer('DevicesFound')) {
                return json_encode([
                    'actions' => [
                        [
                            'type' => 'Configurator',
                            'values' => [
                                [
                                    'name' => 'ImageTest',
                                    'address' => '-',
                                    'instanceID' => 0,
                                    'create' => [
                                        'moduleID' => '{CA44FD1A-754F-4B54-89B3-4B71C3AEE188}',
                                        'configuration' => new stdClass
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
            }
            else {
                if (!$this->GetBuffer('TimerActive')) {
                    $this->SetTimerInterval('LoadDevicesTimer', 1000 * 6);
                }
                $this->SetBuffer('TimerActive', 'true');

                return json_encode([
                    'actions' => [
                        [
                            'type' => 'Configurator'
                        ]
                    ]
                ]);
            }
        }
        
        public function LoadDevices() {
            $this->SetBuffer('DevicesFound', 'true');
            $this->SetBuffer('TimerActive', '');
            $this->SetTimerInterval('LoadDevicesTimer', 0);
            $this->ReloadForm();
        }

        public function ClearDevices() {
            $this->SetBuffer('DevicesFound', '');
        }
    }
    
?>
