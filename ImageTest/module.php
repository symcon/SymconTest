<?
class ImageTest extends IPSModule {
    
    public function Create(){
        //Never delete this line!
        parent::Create();

        $this->RegisterPropertyInteger('media', 0);
    }

    public function GetConfigurationForm() {
        return json_encode([
            "elements" => [
                [
                    "type" => "Image",
                    "image" => "data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg=="
                ],
                [
                    "type" => "SelectMedia",
                    "name" => "media",
                    "caption" => "Image/Stream below"
                ],
                [
                    "type" => "Image",
                    "mediaID" => $this->ReadPropertyInteger('media')
                ],
                [
                    "type" => "Label",
                    "caption" => "Fixed width"
                ],
                [
                    "type" => "Image",
                    "caption" => "fixed",
                    "mediaID" => $this->ReadPropertyInteger('media'),
                    "width" => "100px"
                ],
                [
                    "type" => "RowLayout",
                    "items" => [
                        [
                            "type" => "Label",
                            "caption" => "link auto"
                        ],
                        [
                            "type" => "Image",
                            "image" => "data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==",
                            "onClick" => "echo 'https://symcon.de';"
                        ],
                        [
                            "type" => "Label",
                            "caption" => "link false"
                        ],
                        [
                            "type" => "Image",
                            "image" => "data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==",
                            "onClick" => "echo 'https://symcon.de';",
                            "link" => false
                        ],
                        [
                            "type" => "Label",
                            "caption" => "link true"
                        ],
                        [
                            "type" => "Image",
                            "image" => "data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==",
                            "onClick" => "echo 'https://symcon.de';",
                            "link" => true
                        ]
                    ]
                ],
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
}

?>