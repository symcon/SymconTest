<?php

class ListLoadValuesFromConfigurationTest extends IPSModule
{
    
    public function Create() {
        //Never delete this line!
        parent::Create();

        $this->RegisterPropertyString('Targets', '[]');

    }

    public function ApplyChanges() {
        //Never delete this line!
        parent::ApplyChanges();
    }   

    public function GetConfigurationForm()
    {
        $Form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);
        // Fehler tritt nur auf wenn
        // Liste in ExpansionPanel
        // UND onClick in ExpansionPanel
        // UND ExpansionPanel beim laden geschlossen ist
        // UND
        // {
        // 'values' in form.json vorhanden als "values": [] 
        // ODER
        // GetConfigurationForm setzt 'values' auf []
        // }
        //$Values=[];
        //$Form['elements'][0]['items'][0]['values'] = $Values;
        return json_encode($Form);
    }
}
