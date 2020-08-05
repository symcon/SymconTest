<?

    class BelatedDiscoveryTest extends IPSModule
    {
        public function Create() {
            parent::Create();
            
            // Only required for pre 5.5
            if (floatval(IPS_GetKernelVersion()) < 5.5) {
                $this->RegisterTimer('LoadDevicesTimer', 0, 'BDT_LoadDevices($_IPS["TARGET"]);');
            }

            $this->SetBuffer('Devices', json_encode([]));
            $this->SetBuffer('SearchActive', json_encode(false));
        }

        public function GetConfigurationForm() {
            $this->SendDebug('GetConfigurationForm', 'Start', 0);
            $this->SendDebug('SearchActive', $this->GetBuffer('SearchActive'), 0);
            $devices = json_decode($this->GetBuffer('Devices'));

            // Do not start a new search, if a search is currently active
            if (!json_decode($this->GetBuffer('SearchActive'))) {
                $this->SetBuffer('SearchActive', json_encode(true));

                // Start device search in a timer, not prolonging the execution of GetConfigurationForm
                if (floatval(IPS_GetKernelVersion()) < 5.5) {
                    $this->SetTimerInterval('LoadDevicesTimer', 200);
                }
                else {
                    $this->SendDebug('Start', 'OnceTimer', 0);
                    $this->RegisterOnceTimer('LoadDevicesTimer', 'BDT_LoadDevices($_IPS["TARGET"]);');
                }
            }

            return json_encode([
                'actions' => [
                    // Inform user, that the search for devices could take a while if no devices were found yet
                    [
                        'name' => 'searchingInfo',
                        'type' => 'ProgressBar',
                        'caption' => 'The configurator is currently searching for devices. This could take a while...',
                        'indeterminate' => true,
                        'visible' => count($devices) == 0
                    ],
                    [
                        'name' => 'configurator',
                        'type' => 'Configurator',
                        'values' => $devices
                    ]
                ]
            ]);
        }
        
        public function LoadDevices() {
            $this->SendDebug('LoadDevices', 'Start', 0);
            // Device Search is taking a looooong time...
            IPS_Sleep(10000);
            $this->SendDebug('LoadDevices', 'Wait done', 0);

             // Only required for pre 5.5
            if (floatval(IPS_GetKernelVersion()) < 5.5) {
                $this->SetTimerInterval('LoadDevicesTimer', 0);
            }
            $this->SetBuffer('SearchActive', json_encode(false));
            $this->SendDebug('LoadDevices', 'SearchActive deactivated', 0);
            $newDevices = json_encode([
                [
                    'name' => 'ImageTest',
                    'address' => '-',
                    'instanceID' => 0,
                    'create' => [
                        'moduleID' => '{CA44FD1A-754F-4B54-89B3-4B71C3AEE188}',
                        'configuration' => new stdClass
                    ]
                ]
            ]);
            $this->SetBuffer('Devices', $newDevices);
            $this->UpdateFormField('configurator', 'values', $newDevices);
            $this->UpdateFormField('searchingInfo', 'visible', false);
        }

        // Remove devices, just for testing
        public function ClearDevices() {
            $this->SetBuffer('Devices', json_encode([]));
        }
    }
    
?>
