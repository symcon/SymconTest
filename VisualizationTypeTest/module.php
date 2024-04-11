<?php

    class VisualizationTypeTest extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();
            
            $this->RegisterPropertyInteger('VisualizationType', 1);
        }

        public function ApplyChanges() {
            parent::ApplyChanges();

            $this->SetVisualizationType($this->ReadPropertyInteger('VisualizationType'));
        }

        public function GetVisualizationTile() {
            return '<div> Ich bin HTML! </div>';
        }
    }
