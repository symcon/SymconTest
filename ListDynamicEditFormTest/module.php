<?php

    class ListDynamicEditFormTest extends IPSModule
    {
        public function Create() {
            //Never delete this line!
            parent::Create();
            
            $this->RegisterPropertyString("infos", "");
            $this->RegisterPropertyString("infos2", "");
            $this->RegisterPropertyString("infos3", "");
            $this->RegisterPropertyString("tree", "");

        }

        public function UpdateInfos($infos) {
            $newInfos = [];
            foreach ($infos as $info) {
                $newInfos[] = [
                    'info1' => $info['info1'],
                    'info2' => $info['info2'],
                    'info' => $info['info1'] . $info['info2'],
                    'active' => $info['active']
                ];
            }
            $this->UpdateFormField('infos', 'values', json_encode($newInfos));
        }
    }
