<?

    class ConfiguratorInvisibleTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyBoolean('Visible', false);
        }



        public function GetConfigurationForm() {
            return json_encode([
                'elements' => [
                    [
                        'type' => 'Configurator',
                        'name' => 'Configurator',
                        'caption' => 'Configurator',
                        'visible' => $this->ReadPropertyBoolean('Visible'),
                        'delete' => false,
                        'sort' => [
                            'column' => 'name',
                            'direction' => 'ascending'
                        ],
                        'values' => [[
                            'id' => 1,
                            'name' => 'Category',
                            'address' => ''
                        ],
                        [
                            'id' => 2,
                            'parent' => 1,
                            'name' => 'Shutter Control (Markise)',
                            'address' => 'Adress',
                            'create' => [
                                'moduleID' => '{542CC907-CA63-4E7A-A8C7-92F74639FA4C}',
                                'configuration' => [
                                    'ShutterType' => 1
                                ]
                            ]
                        ]]
                    ],
                    [
                        'type' => 'CheckBox',
                        'caption' => 'Visible',
                        'name' => 'Visible',
                        'onChange' => 'CIT_UpdateVisible($id, $Visible);'
                    ]
                ],
                'actions' => []
            ]);
        }



        public function UpdateVisible($Visible) {
            $this->UpdateFormField('Configurator', 'visible', $Visible);
        }
    }

?>
