<?php

    class PopupWizardTest extends IPSModule
    {
        public function Create()
        {
            parent::Create();
        }

        public function ShowPopup()
        {
            $this->UpdateFormField('WizardAlert', 'visible', true);
        }
    }
