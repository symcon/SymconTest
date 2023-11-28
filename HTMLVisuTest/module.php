<?php

    class HTMLVisuTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();
            
            $this->RegisterVariableInteger('Counter', 'Counter');
            $this->EnableAction('Counter');
            $this->SetVisualizationType(1);
        }

        public function RequestAction($Ident, $Value) {
            $this->SendDebug('HTML Update', 'Start', 0);
            switch ($Ident) {
                case 'Counter':
                    $this->SetValue($Ident, $Value);
                    break;

                case 'Add':
                    $this->SetValue('Counter', $this->GetValue('Counter') + $Value);
                    break;
            }

            $this->UpdateVisualizationValue(strval($this->GetValue('Counter')));
            $this->SendDebug('HTML Update', 'Done', 0);
        }
        
        public function GetVisualizationTile() {
            return  '<script>function handleMessage(data) { document.getElementById("display").innerText = data; }</script>' .
                    '<button onClick="requestAction(\'Add\', -1);">-1</button>' . 
                    '<div>Counter:</div>' .
                    '<div id="display">' . $this->GetValue('Counter') . '</div>' .
                    '<div>ducks</div>' .
                    '<button onClick="requestAction(\'Add\', +1);">+1</button>';
        }
    
    }

?>
