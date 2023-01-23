<?php

    class PopupAlertTest extends IPSModule
    {
        public function Create()
        {
            parent::Create();
            
            $this->RegisterTimer('UpdateError', 0, 'PAT_Update(' . $this->InstanceID . ');');
        }
        
        public function Update()
        {
            $visible = boolval($this->GetBuffer('visible'));
            $this->UpdateFormField('ErrorPopup', 'visible', $visible);
            IPS_SetName($this->InstanceID, 'PopupAlertTest ' . ($visible ? '(Popup open)' : '(Popup closed)'));
            $this->SetBuffer('visible', $visible ? '' : '1');
        }

        public function Stop()
        {
            $this->SetTimerInterval('UpdateError', 0);
        }

        public function GetConfigurationForm()
        {
            $this->SetTimerInterval('UpdateError', 10*1000);
            $Form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);
            return json_encode($Form);
        }
    }
