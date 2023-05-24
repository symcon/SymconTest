<?php

    class OpenObjectButtonTest extends IPSModule
    {

        function Create() {
			parent::Create();

            if (@$this->GetIDForIdent('Category') === false) {
                $objectID = IPS_CreateCategory();
                IPS_SetParent($objectID, $this->InstanceID);
                IPS_SetIdent($objectID, 'Category');
                IPS_SetName($objectID, 'Category');
            }

            if (@$this->GetIDForIdent('Instance') === false) {
                $objectID = IPS_CreateInstance('{485D0419-BE97-4548-AA9C-C083EB82E61E}');
                IPS_SetParent($objectID, $this->InstanceID);
                IPS_SetIdent($objectID, 'Instance');
                IPS_SetName($objectID, 'Instance');
            }
            
            $this->RegisterVariableBoolean('Variable', 'Variable');
            
            $this->RegisterScript('Script', 'Script');

            if (@$this->GetIDForIdent('Event') === false) {
                $objectID = IPS_CreateEvent(0);
                IPS_SetParent($objectID, $this->InstanceID);
                IPS_SetIdent($objectID, 'Event');
                IPS_SetName($objectID, 'Event');
            }

            if (@$this->GetIDForIdent('Media') === false) {
                $objectID = IPS_CreateMedia(1);
                IPS_SetParent($objectID, $this->InstanceID);
                IPS_SetIdent($objectID, 'Media');
                IPS_SetName($objectID, 'Media');
            }

            if (@$this->GetIDForIdent('Link') === false) {
                $objectID = IPS_CreateLink();
                IPS_SetParent($objectID, $this->InstanceID);
                IPS_SetIdent($objectID, 'Link');
                IPS_SetName($objectID, 'Link');
            }

            $this->ForceParent('{8DFFA466-FDA4-9268-946B-CB2D739A5D0D}');
        }

        function GetConfigurationForm() {
            return json_encode([
                'actions' => [
                    [
                        'type' => 'OpenObjectButton',
                        'caption' => 'Category',
                        'objectID' => $this->GetIDForIdent('Category')
                    ],
                    [
                        'type' => 'OpenObjectButton',
                        'caption' => 'Instance',
                        'objectID' => $this->GetIDForIdent('Instance')
                    ],
                    [
                        'type' => 'OpenObjectButton',
                        'caption' => 'Variable',
                        'objectID' => $this->GetIDForIdent('Variable')
                    ],
                    [
                        'type' => 'OpenObjectButton',
                        'caption' => 'Script',
                        'objectID' => $this->GetIDForIdent('Script')
                    ],
                    [
                        'type' => 'OpenObjectButton',
                        'caption' => 'Event',
                        'objectID' => $this->GetIDForIdent('Event')
                    ],
                    [
                        'type' => 'OpenObjectButton',
                        'caption' => 'Media',
                        'objectID' => $this->GetIDForIdent('Media')
                    ],
                    [
                        'type' => 'OpenObjectButton',
                        'caption' => 'Link',
                        'objectID' => $this->GetIDForIdent('Link')
                    ]
                ]
            ]);
        }
    }
    
?>
