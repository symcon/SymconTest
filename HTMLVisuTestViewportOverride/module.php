<?php

    class HTMLVisuTestViewportOverride extends IPSModule
    {
        
        public function Create() {
            // Visualisierungstyp auf 1 setzen, da wir HTML anbieten möchten
            $this->SetVisualizationType(1);
        }
        
        public function GetVisualizationTile() {
            // Füge statisches HTML aus Datei hinzu
            return file_get_contents(__DIR__ . '/module.html');
        }    
    }

?>
