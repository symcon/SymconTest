<?php

    class HTMLVisuTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();
            
            $this->RegisterVariableInteger('Counter', 'Counter');
            $this->SetVisualizationType(1);

        }

        public function RequestAction($Ident, $Value) {
            switch ($Ident) {
                case 'Counter':
                    $this->SetValue($Ident, $Value);
                    break;

                case 'Add':
                    $this->SetValue('Counter', $this->GetValue('Counter') + 1);
                    break;
            }
        }
        
        public function GetVisualizationTile() {
            // TODO: First script is to be injected
            return '<script>' .
                        'function requestAction(ident, value) {' .
                            'if (window.RequestAction) {' .
                                'window.RequestAction(JSON.stringify({ident, value}));' .
                            '} else' .
                            '{' .
                                'window.parent.postMessage({ident, value});' .
                            '}' .
                        '}' .
                        'window.addEventListener("message",' .
                            '(event) => {' .
                                'if (window.handleMessage) {' .
                                    'window.handleMessage(event.data);' .
                                '}' .
                            '}, false);' .
                    '</script>' .

                    '<script>function handleMessage(data) { document.getElementById("display").innerText = data; }</script>' .
                    '<button onClick="requestAction(\'Add\', -1);">-1</button>' . 
                    '<div id="display">' . $this->GetValue('Counter') . '</div>' .
                    '<button onClick="requestAction(\'Add\', +1);">+1</button>';
        }
    
    }

?>
