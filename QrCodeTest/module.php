<?php
class QrCodeTest extends IPSModule {
    
    public function Create(){
        //Never delete this line!
        parent::Create();
    }

    public function GetConfigurationForm() {
        return json_encode([
            "elements" => [
                [
                    "type" => "QrCode",
                    "caption" => "Generierter QRCode",
                    "name" => "Code",
                    "source" => "Dies ist ein BeispielText",
                    "description" => true, 
                ],
                [
                    "type" => "RowLayout",
                    "items" => [
                        [
                            "type" => "Button",
                            "caption" => "Text: Dies ist ein Beispieltext",
                            "onClick" => 'QT_UIUpdate($id, \'source\' ,\'Dies ist ein Beispieltext\');'
                        ],
                        [
                            "type" => "Button",
                            "caption" => "Text: Symcon ist klasse!",
                            "onClick" => 'QT_UIUpdate($id, \'source\' ,\'Symcon ist klasse\');'
                        ],
                        [
                            "type" => "Button",
                            "caption" => "Text: 日本語の新しいQRコード", //Neuer QR-Code auf Japanisch
                            "onClick" => 'QT_UIUpdate($id, \'source\', \'日本語の新しいQRコード\');'
                        ],
                        [
                            "type" =>  "CheckBox", 
                            "name"=> "ImageDescription", 
                            "value" => true,
                            "caption" =>  "Bildunterschrift anzeigen",
                            "onChange" => 'QT_UIUpdate($id,\'descriptionVisible\', $ImageDescription);'
                        ],
                        [
                            "type" =>  "CheckBox", 
                            "name"=> "Invisible", 
                            "caption" =>  "Sichtbar",
                            "value" => true,
                            "onChange" => 'QT_UIUpdate($id,\'visible\', $Invisible);'
                        ]
                    ]
                ]
                
            ]
        ]);
    }

    public function Destroy(){
        //Never delete this line!
        parent::Destroy();
    }

    public function ApplyChanges(){
        //Never delete this line!
        parent::ApplyChanges();
    }

    public function UIUpdate(string $field, $value) {
        $this->UpdateFormField('Code', $field, $value);
        $this->SendDebug($field, $value, 0);
    }
}

?>