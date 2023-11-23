<?php

    class ListButtonTest extends IPSModule
    {
        public function GetConfigurationForm() {
            return json_encode([
                'actions' => [
                    [
                        'type' => 'List',
                        'columns' => [
                            [
                                'name' => 'objectID',
                                'caption' => 'Object',
                                'edit' => [
                                    'type' => 'OpenObjectButton'
                                ],
                                'width' => 'auto'
                            ]
                        ],
                        'values' => [
                            [
                                'objectID' => IPS_GetInstanceListByModuleID('{43192F0B-135B-4CE7-A0A7-1475603F3060}')[0]
                            ]
                        ]

                    ]
                ]
            ]);
        }
    }
