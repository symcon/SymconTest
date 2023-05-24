<?php

    class OpenObjectFromPopupTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyBoolean('Visible', false);
        }



        public function GetConfigurationForm() {
            return json_encode([
                'actions' => [
                    [
                        'type' => 'PopupButton',
                        'caption' => 'Open Popup',
                        'popup' => [
                            'items' => [
                                [
                                    'type' => 'OpenObjectButton',
                                    'caption' => 'Open Connect',
                                    'objectID' => IPS_GetInstanceListByModuleID('{9486D575-BE8C-4ED8-B5B5-20930E26DE6F}')[0]
                                ],
                                [
                                    'type' => 'Configurator',
                                    'values' => [
                                        [
                                            'name' => 'Connect',
                                            'address' => '',
                                            'instanceID' => IPS_GetInstanceListByModuleID('{9486D575-BE8C-4ED8-B5B5-20930E26DE6F}')[0]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        }
    }

?>
