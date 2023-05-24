<?php

    class DynamicLinkLabelTest extends IPSModule
    {
        public function UpdateLabel($Text) {
            $this->UpdateFormField('Label', 'caption', $Text);
        }

        public function UpdateLink($Link) {
            $this->UpdateFormField('Label', 'link', $Link);
        }
    }
    
?>
