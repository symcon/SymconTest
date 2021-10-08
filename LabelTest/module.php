<?

    class LabelTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyInteger('Color', 0);
            $this->RegisterPropertyBoolean('Bold', false);
            $this->RegisterPropertyBoolean('Underline', false);
            $this->RegisterPropertyBoolean('Italic', false);
        }

        public function GetConfigurationForm() {
            return json_encode([
                'elements' => [
                    [
                        'type' => 'Label',
                        'caption' => 'This is a regular label'
                    ],
                    [
                        'type' => 'Label',
                        'name' => 'Label',
                        'caption' => 'This is a nice dynamic label',
                        'color' => $this->ReadPropertyInteger('Color'),
                        'bold' => $this->ReadPropertyBoolean('Bold'),
                        'underline' => $this->ReadPropertyBoolean('Underline'),
                        'italic' => $this->ReadPropertyBoolean('Italic')
                    ],
                    [
                        'type' => 'SelectColor',
                        'name' => 'Color',
                        'caption' => 'Color',
                        'onChange' => 'LT_UpdateColor(' . $this->InstanceID . ', $Color);'
                    ],
                    [
                        'type' => 'CheckBox',
                        'name' => 'Bold',
                        'caption' => 'Bold',
                        'onChange' => 'LT_UpdateBold(' . $this->InstanceID . ', $Bold);'
                    ],
                    [
                        'type' => 'CheckBox',
                        'name' => 'Underline',
                        'caption' => 'Underline',
                        'onChange' => 'LT_UpdateUnderline(' . $this->InstanceID . ', $Underline);'
                    ],
                    [
                        'type' => 'CheckBox',
                        'name' => 'Italic',
                        'caption' => 'Italic',
                        'onChange' => 'LT_UpdateItalic(' . $this->InstanceID . ', $Italic);'
                    ]
                ]
            ]);
        }

        public function UpdateColor($color) {
            $this->UpdateFormField('Label', 'color', $color);
        }

        public function UpdateBold($bold) {
            $this->UpdateFormField('Label', 'bold', $bold);
        }

        public function UpdateUnderline($underline) {
            $this->UpdateFormField('Label', 'underline', $underline);
        }

        public function UpdateItalic($italic) {
            $this->UpdateFormField('Label', 'italic', $italic);
        }
    }

?>
