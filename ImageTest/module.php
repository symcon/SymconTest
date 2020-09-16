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
}

?>