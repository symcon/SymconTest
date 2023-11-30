<?php

    class HTMLVisuTestHeatingPump extends IPSModule
    {
        
        public function Create() {
            //Never delete this line!
            parent::Create();

            if (!IPS_VariableProfileExists('HeatingPump.Status')) {
                IPS_CreateVariableProfile('HeatingPump.Status', 1);
                IPS_SetVariableProfileAssociation('HeatingPump.Status', 0, 'Aus', '', -1);
                IPS_SetVariableProfileAssociation('HeatingPump.Status', 3, 'Heizen', '', -1);
                IPS_SetVariableProfileAssociation('HeatingPump.Status', 4, 'Abtauen', '', -1);
                IPS_SetVariableProfileAssociation('HeatingPump.Status', 5, 'Warmwasser', '', -1);
            }
            
            $this->RegisterVariableInteger('Status', 'Status', 'HeatingPump.Status');

            if (!IPS_VariableProfileExists('HeatingPump.Mode')) {
                IPS_CreateVariableProfile('HeatingPump.Mode', 1);
                IPS_SetVariableProfileAssociation('HeatingPump.Mode', 0, 'Normal', '', -1);
                IPS_SetVariableProfileAssociation('HeatingPump.Mode', 1, 'Silent', '', -1);
                IPS_SetVariableProfileAssociation('HeatingPump.Mode', 2, 'Eco', '', -1);
            }
            
            $this->RegisterVariableInteger('Mode', 'Mode', 'HeatingPump.Mode');
            $this->RegisterVariableFloat('OutdoorTemperature', 'Outdoor Temperature', '~Temperature');
            $this->RegisterVariableFloat('WaterTemperature', 'Water Temperature', '~Temperature');
            $this->RegisterVariableFloat('FlowTemperature', 'Flow Temperature', '~Temperature');
            $this->RegisterVariableFloat('ReturnTemperature', 'Return Temperature', '~Temperature');
            $this->RegisterVariableBoolean('HeaterRodBackupStatus', 'Heater Rod Backup active?', '~Switch');
            $this->RegisterVariableBoolean('HeaterRodPhase1', 'Heater Rod Phase 1', '~Switch');
            $this->RegisterVariableBoolean('HeaterRodPhase2', 'Heater Rod Phase 2', '~Switch');
            $this->RegisterVariableBoolean('HeaterRodPhase3', 'Heater Rod Phase 3', '~Switch');

            if (!IPS_VariableProfileExists('HeatingPump.Flow')) {
                IPS_CreateVariableProfile('HeatingPump.Flow', 2);
                IPS_SetVariableProfileValues('HeatingPump.Flow', 0, 1700, 100);
                IPS_SetVariableProfileText('HeatingPump.Flow', '', 'l/h');
            }
            $this->RegisterVariableFloat('Flow', 'Flow', 'HeatingPump.Flow');

            if (!IPS_VariableProfileExists('HeatingPump.Rotations')) {
                IPS_CreateVariableProfile('HeatingPump.Rotations', 2);
                IPS_SetVariableProfileValues('HeatingPump.Rotations', 0, 650, 50);
                IPS_SetVariableProfileText('HeatingPump.Rotations', '', 'rpm');
            }
            
            $this->RegisterVariableFloat('FanRotations', 'Fan Rotations', 'HeatingPump.Rotations');

            if (!IPS_VariableProfileExists('HeatingPump.Compressor')) {
                IPS_CreateVariableProfile('HeatingPump.Compressor', 2);
                IPS_SetVariableProfileValues('HeatingPump.Compressor', 0, 75, 5);
                IPS_SetVariableProfileText('HeatingPump.Compressor', '', 'Hz');
            }
            
            $this->RegisterVariableFloat('CompressorPower', 'Compressor Power', 'HeatingPump.Compressor');

            $this->RegisterVariableFloat('COP', 'COP Value');
            $this->RegisterVariableFloat('SPF', 'Seasonal Performance Factor (SPF)');
            $this->RegisterVariableFloat('SPFHeating', 'SPF Heating');
            $this->RegisterVariableFloat('SPFWater', 'SPF Water');

            if (!IPS_VariableProfileExists('HeatingPump.Power')) {
                IPS_CreateVariableProfile('HeatingPump.Power', 2);
                IPS_SetVariableProfileValues('HeatingPump.Power', 0, 7, 0.5);
                IPS_SetVariableProfileText('HeatingPump.Power', '', 'kW');
            }
            
            $this->RegisterVariableFloat('Power', 'Power', 'HeatingPump.Power');
            
            $this->RegisterVariableFloat('Consumption', 'Consumption', '~Watt');

            $this->RegisterVariableFloat('ConsumptionToday', 'Consumption today', '~Electricity');

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
            return file_get_contents(__DIR__ . '/heating_pump.html');
        }
    
    }

?>
