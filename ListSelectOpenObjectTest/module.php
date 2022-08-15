<?php

    class ListSelectOpenObjectTest extends IPSModule
    {
        public function RequestAction($Ident, $Value)
        {
            if ($Ident == 'UpdateOpenObjectButton') {
                $this->UpdateFormField('OpenEventReceiversInstance', 'objectID', $Value);
                $this->UpdateFormField('OpenEventReceiversInstance', 'enabled', true);
                $this->UpdateFormField('OpenEventReceiversInstance', 'caption', sprintf('Open instance (%d): %s', $Value, IPS_GetName($Value)));
                return;
            }
        }

        public function GetConfigurationForm()
        {
            $Form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);
            $EventList = $this->GetEventReceiverFormValues();
            $Form['actions'][0]['values'] = $EventList;
            return json_encode($Form);
        }

        protected function GetEventReceiverFormValues()
        {
            $EventList = [];
            $Instances = IPS_GetInstanceList();
            shuffle($Instances);
            $i=0;
            $Receivers = [];
            do {
                $Receiver = array_shift($Instances);
                $Receivers[] = [
                    'instanceID' => $Receiver,
                    'Name'       => IPS_GetName($Receiver),
                    'Type'       => substr(IPS_GetInstance($Receiver)['ModuleInfo']['ModuleName'], 6)
                ];
                $i++;
            } while (count($Instances) && $i<5);
               
            $EventList[] = [
                    'Topic'      => 'bla bla Topic',
                    'Receivers'  => $Receivers
                ];
            
            return $EventList;
        }
    }
