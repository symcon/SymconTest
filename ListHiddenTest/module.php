<?php

    class ListHidden extends IPSModule
    {
        public function Create()
        {
            //Never delete this line!
            parent::Create();
        }
        
        public function ToggleVisibility(bool $Visible)
        {
            $this->UpdateFormField('List', 'visible', $Visible);
        }

        public function ToggleRowCount(bool $RowCount)
        {
            $this->UpdateFormField('List', 'rowCount', $RowCount ? 10 : 0);
        }
    }
