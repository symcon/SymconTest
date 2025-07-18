<?php

    class TestCenterPresentationTest extends IPSModule
    {

        public function Create()
        {
            //Never delete this line!
            parent::Create();
            
            $this->RegisterVariableBoolean('SomeSwitch', 'Some Switch', [
                'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
            
            ]);
            $this->EnableAction('SomeSwitch');
            $this->RegisterVariableInteger('SomeEnumeration', 'Some Enumeration', [
                'PRESENTATION' => VARIABLE_PRESENTATION_ENUMERATION
            ]);
            $this->EnableAction('SomeEnumeration');
            $this->RegisterVariableInteger('SomeDateTime', 'Some Date/Time', [
                'PRESENTATION' => VARIABLE_PRESENTATION_DATE_TIME
            ]);
            $this->EnableAction('SomeDateTime');
            $this->RegisterVariableInteger('SomeSlider', 'Some Slider', [
                'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            ]);
            $this->EnableAction('SomeSlider');
            $this->RegisterVariableInteger('SomeShutter', 'Some Shutter', [
                'PRESENTATION' => VARIABLE_PRESENTATION_SHUTTER,
            ]);
            $this->EnableAction('SomeShutter');
            $this->RegisterVariableFloat('SomeFloat', 'Some Float', [
                'PRESENTATION' => VARIABLE_PRESENTATION_VALUE_INPUT
            ]);
            $this->EnableAction('SomeFloat');
            $this->RegisterVariableInteger('SomeInt', 'Some Integer', [
                'PRESENTATION' => VARIABLE_PRESENTATION_VALUE_INPUT
            ]);
            $this->EnableAction('SomeInt');
            $this->RegisterVariableString('SomeString', 'Some String', [
                'PRESENTATION' => VARIABLE_PRESENTATION_VALUE_INPUT
            ]);
            $this->EnableAction('SomeString');
            
            $this->RegisterVariableInteger('ColorInt', 'Color (Int)', [
                'PRESENTATION' => VARIABLE_PRESENTATION_COLOR
            ]);
            $this->EnableAction('ColorInt');
            $this->RegisterVariableString('ColorRgb', 'Color (RGB)', [
                'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
                'ENCODING'     => 0
            ]);
            $this->EnableAction('ColorRgb');
            $this->RegisterVariableString('ColorCmyk', 'Color (CMYK)', [
                'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
                'ENCODING'     => 1
            ]);
            $this->EnableAction('ColorCmyk');
            $this->RegisterVariableString('ColorHsv', 'Color (HSV)', [
                'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
                'ENCODING'     => 2
            ]);
            $this->EnableAction('ColorHsv');
            $this->RegisterVariableString('ColorHsl', 'Color (HSL)', [
                'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
                'ENCODING'     => 3
            ]);
            $this->EnableAction('ColorHsl');
            $this->RegisterVariableString('ColorXy', 'Color (XY)', [
                'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
                'ENCODING'     => 4
            ]);
            $this->EnableAction('ColorXy');
        }


        public function RequestAction($Ident, $Value)
        {
            SetValue($this->GetIDForIdent($Ident), $Value);
        }
    }
    
?>
