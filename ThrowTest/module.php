<?php

    // Test case for https://community.symcon.de/t/144258/51
    //
    // When a Throwable escapes a module entry point, the kernel log should show
    // class, message and file:line of the Throwable. Currently the log line is
    // empty (Rust) or lacks the message (C++).
    //
    // Every throw site below uses a unique message text, so it is immediately
    // visible whether the text makes it into the log.

    class ThrowTest extends IPSModule
    {
        public function Create()
        {
            parent::Create();

            $this->RegisterPropertyBoolean('ThrowOnKernelReady', false);
            $this->RegisterPropertyBoolean('ThrowOnApplyChanges', false);

            $this->RegisterTimer('ThrowTimer', 0, 'THT_ThrowFromTimer($_IPS[\'TARGET\']);');
        }

        public function ApplyChanges()
        {
            $this->RegisterMessage(0, IPS_KERNELMESSAGE);

            parent::ApplyChanges();

            if ($this->ReadPropertyBoolean('ThrowOnApplyChanges')) {
                throw new Exception('ThrowTest: Exception from ApplyChanges');
            }
        }

        public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
        {
            if (($Message == IPS_KERNELMESSAGE) && ($Data[0] == KR_READY) && $this->ReadPropertyBoolean('ThrowOnKernelReady')) {
                // Reproduces the original real-world case: an engine-thrown TypeError
                // escaping MessageSink. Since 9.1 the constants group is named 'Symcon',
                // so this expression evaluates to null and array_search() throws:
                // "array_search(): Argument #2 ($haystack) must be of type array, null given"
                array_search($Message, get_defined_constants(true)['IP-Symcon'], true);
            }
        }

        public function RequestAction($Ident, $Value)
        {
            throw new Exception('ThrowTest: Exception from RequestAction (Ident: ' . $Ident . ')');
        }

        public function ThrowFromPublicFunction()
        {
            throw new Exception('ThrowTest: Exception from public module function');
        }

        public function StartThrowTimer()
        {
            $this->SetTimerInterval('ThrowTimer', 1000);
        }

        public function ThrowFromTimer()
        {
            $this->SetTimerInterval('ThrowTimer', 0);

            throw new Exception('ThrowTest: Exception from timer callback');
        }

        public function GetConfigurationForm()
        {
            return json_encode([
                'elements' => [
                    [
                        'type'    => 'CheckBox',
                        'name'    => 'ThrowOnKernelReady',
                        'caption' => 'Throw TypeError in MessageSink on KR_READY (takes effect on next restart)'
                    ],
                    [
                        'type'    => 'CheckBox',
                        'name'    => 'ThrowOnApplyChanges',
                        'caption' => 'Throw Exception in ApplyChanges'
                    ]
                ],
                'actions'  => [
                    [
                        'type'    => 'Button',
                        'caption' => 'Throw in RequestAction',
                        'onClick' => 'IPS_RequestAction($id, \'Throw\', true);'
                    ],
                    [
                        'type'    => 'Button',
                        'caption' => 'Throw in public module function',
                        'onClick' => 'THT_ThrowFromPublicFunction($id);'
                    ],
                    [
                        'type'    => 'Button',
                        'caption' => 'Throw in timer callback (fires after 1 second)',
                        'onClick' => 'THT_StartThrowTimer($id);'
                    ]
                ]
            ]);
        }
    }

?>
