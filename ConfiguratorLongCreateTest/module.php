<?php

    class ConfiguratorLongCreateTest extends IPSModuleStrict
    {
        public function GetConfigurationForm(): string
        {
            return json_encode([
                'actions' => [
                    [
                        'type' => 'Configurator',
                        'name' => 'Configurator',
                        'values' => $this->GetValues(),
                        'delete' => true
                    ],
                    [
                        'type' => 'Button',
                        'caption' => 'Update Values',
                        'onClick' => 'CLCT_UpdateValues($id);'
                    ]
                ],
            ]);
        }

        public function UpdateValues() {
            $this->UpdateFormField('Configurator', 'values', json_encode($this->GetValues()));
        }

        private function GetValues() : array
        {
            $longCreateIDs = IPS_GetInstanceListByModuleID('{E41B0744-98B3-4A79-863A-7DB080CA1219}');
            $instanceID = 1;
            foreach ($longCreateIDs as $id) {
                if (LC_IsCreated($id)) {
                    $instanceID = $id;
                    break;
                }
            }
            return [
                [
                    'name' => 'Long Create',
                    'instanceID' => $instanceID,
                    'create' => [
                        'moduleID' => '{E41B0744-98B3-4A79-863A-7DB080CA1219}',
                        'configuration' => new stdClass()
                    ]
                ],
            ];
        }
    }
