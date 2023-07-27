<?php

    class ListDynamicEditFormTest extends IPSModule
    {
        public function UpdateInfos($infos) {
            $newInfos = [];
            foreach ($infos as $info) {
                $newInfos[] = [
                    'info1' => $info['info1'],
                    'info2' => $info['info2'],
                    'info' => $info['info1'] . $info['info2']
                ];
            }
            $this->UpdateFormField('infos', 'values', json_encode($newInfos));
        }
    }
