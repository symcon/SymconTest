<?php

    class ConfiguratorIOAware extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->ForceParent("{0C7C84AA-494F-A12E-FD4F-D2D6431D6E3D}");
        }

        public function GetConfigurationForm() {
            $foundAdresses = [1, 2, 3]; // The detected adresses, in a real implementation this would be read via the API of the implemented system

            // Get all the instances that are connected to the configurators I/O
            $connectedInstanceIDs = [];
            foreach (IPS_GetInstanceListByModuleID('{F7CA1AA2-5817-0ACB-1AA2-47DF12AF6CFE}') as $instanceID) {
                if (IPS_GetInstance($instanceID)['ConnectionID'] === IPS_GetInstance($this->InstanceID)['ConnectionID']) {
                    // Add the instance ID to a list for the given address. Even though addresses should be unique, users could break things by manually editing the settings
                    $connectedInstanceIDs[IPS_GetProperty($instanceID, 'Address')][] = $instanceID;
                }
            }

            $values = [];
            foreach ($foundAdresses as $foundAddress) {
                $value = [
                    'address' => $foundAddress,
                    'create' => [
                        'moduleID' => '{F7CA1AA2-5817-0ACB-1AA2-47DF12AF6CFE}',
                        'configuration' => [
                            'Address' => $foundAddress
                        ]
                    ]
                ];
                if (isset($connectedInstanceIDs[$foundAddress])) {
                    $value['name'] = IPS_GetName($connectedInstanceIDs[$foundAddress][0]);
                    $value['instanceID'] = $connectedInstanceIDs[$foundAddress][0];
                }
                else {
                    $value['name'] = 'Device ' . $foundAddress;
                    $value['instanceID'] = 0;
                }
                $values[] = $value;
            }

            foreach ($connectedInstanceIDs as $address => $instanceIDs) {
                foreach ($instanceIDs as $index => $instanceID) {
                    // The first entry for each found address was already added as valid value
                    if (($index === 0) && (in_array($address, $foundAdresses))) {
                        continue;
                    }

                    // However, if an address is not a found address or an address has multiple instances, they are erroneous
                    $values[] = [
                        'address' => $address,
                        'name' => IPS_GetName($instanceID),
                        'instanceID' => $instanceID
                    ];
                }
            }

            return json_encode([
                'elements' => [
                    [
                        'type' => 'Configurator',
                        'values' => $values
                    ]
                ]
            ]);
        }
		
		public function GetConfigurationForParent() {
			return json_encode([
				'SomeSetting' => 42
			]);
		}
    }

?>
