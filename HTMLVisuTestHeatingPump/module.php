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

            $this->EnableAction('Status');
            $this->EnableAction('Mode');
            $this->EnableAction('OutdoorTemperature');
            $this->EnableAction('WaterTemperature');
            $this->EnableAction('FlowTemperature');
            $this->EnableAction('ReturnTemperature');
            $this->EnableAction('HeaterRodBackupStatus');
            $this->EnableAction('HeaterRodPhase1');
            $this->EnableAction('HeaterRodPhase2');
            $this->EnableAction('HeaterRodPhase3');
            $this->EnableAction('Flow');
            $this->EnableAction('FanRotations');
            $this->EnableAction('CompressorPower');
            $this->EnableAction('COP');
            $this->EnableAction('SPF');
            $this->EnableAction('SPFHeating');
            $this->EnableAction('SPFWater');
            $this->EnableAction('Power');
            $this->EnableAction('Consumption');
            $this->EnableAction('ConsumptionToday');

            $this->SetVisualizationType(1);
        }

        public function RequestAction($Ident, $Value) {
            $this->SetValue($Ident, $Value);

            $this->UpdateVisualizationValue($this->GetUpdatedValue($Ident));
        }
        
        public function GetVisualizationTile() {
            // Inject current values using the message handling function
            $initialHandling = [];
            foreach (IPS_GetChildrenIDs($this->InstanceID) as $variableID) {
                if (!IPS_VariableExists($variableID)) {
                    continue;
                }

                $ident = IPS_GetObject($variableID)['ObjectIdent'];
                if (!$ident) {
                    continue;
                }
                $initialHandling[] = 'handleMessage(\'' . $this->GetUpdatedValue($ident) . '\');';
            }
            $messages = '<script>' . implode(' ', $initialHandling) . '</script>';

            // We need to include the assets directly as there is no way to load anything afterwards yet
            $assets = '<script>';
            $assets .= 'window.assets = {};' . PHP_EOL;
            $assets .= 'window.assets.img_wp_aus = "data:image/webp;base64,' . base64_encode(file_get_contents(__DIR__ . '/assets/wp_aus.webp')) . '";' . PHP_EOL;
            $assets .= 'window.assets.img_wp_heizen = "data:image/webp;base64,' . base64_encode(file_get_contents(__DIR__ . '/assets/wp_heizen.webp')) . '";' . PHP_EOL;
            $assets .= 'window.assets.img_wp_ww = "data:image/webp;base64,' . base64_encode(file_get_contents(__DIR__ . '/assets/wp_ww.webp')) . '";' . PHP_EOL;
            $assets .= '</script>';

            // Add static HTML content from file to make editing easier
            $module = file_get_contents(__DIR__ . '/module.html');

            // Return everything to render our fancy tile!
            return $module . $assets . $messages;
        }

        private function GetUpdatedValue($variableIdent) {
            $variableID = @$this->GetIDForIdent($variableIdent);

            if (($variableID === false) || (!IPS_VariableExists($variableID))) {
                return false;
            }

            $variable = IPS_GetVariable($variableID);

            $profile = $variable['VariableCustomProfile'];
            if ($profile === '') {
                $profile = $variable['VariableProfile'];
            }

            // If Min/Max are not needed you can remove those values
            // The channel
            $p = IPS_VariableProfileExists($profile) ? IPS_GetVariableProfile($profile) : null;
            return json_encode([
                'Ident' => $variableIdent,
                'Value' => $this->GetValue($variableIdent),
                'Min' => $p ? $p['MinValue'] : false,
                'Max' => $p ? $p['MaxValue'] : false,
            ]);
        }
    
    }

?>
