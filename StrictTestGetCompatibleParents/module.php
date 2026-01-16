<?php

    class StrictTestGetCompatibleParents extends IPSModuleStrict
    {
        public function Create(): void
        {
            //Never delete this line!
            parent::Create();
        }

        public function GetCompatibleParents(): string
        {
            return json_encode([
                'type' => 'connect',
                'modules' => [
                    [
                        'moduleID' => '{6DC3D946-0D31-450F-A8C6-C42DB8D7D4F1}',
                        'configuration' => [
                            'Parity' => 'Odd'
                        ],
                        'initial' => [
                            'BaudRate' => '110'
                        ],
                        'formOverride' => [
                            'BaudRate' => [
                                'options' => [
                                    [
                                        'value' => '110',
                                        'caption' => '110'
                                    ],
                                    [
                                        'value' => '115200',
                                        'caption' => '115200'
                                    ]
                                ]
                            ],
                            'Port' => [
                                'options' => [
                                    [
                                        'value' => 'SECRET',
                                        'caption' => 'Secret COM Port'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        }
    }