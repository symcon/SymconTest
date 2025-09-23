<?php

    class HTMLOpenObjectTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();
            
            $this->SetVisualizationType(1);
        }

        public function RequestAction($Ident, $Value) {
            $this->SendDebug('HTML Update', 'Start', 0);
            
            $this->UpdateVisualizationValue(strval($Value));
            $this->SendDebug('HTML Update', 'Done', 0);
        }
        
        public function GetVisualizationTile() {
            return file_get_contents(__DIR__ . '/module.html');
        }
    
    }

?>
