<?php
class PopupDynamicListTest extends IPSModuleStrict {
    
    public function Create(): void {
        //Never delete this line!
        parent::Create();        
    }

    public function Destroy(): void {
        //Never delete this line!
        parent::Destroy();
    }

    public function ApplyChanges(): void {
        //Never delete this line!
        parent::ApplyChanges();
    }

    public function OpenPopup() {
        $this->UpdateFormField('List', 'values', json_encode([
            ['name' => 'Test1'],
            ['name' => 'Test2'],
            ['name' => 'Test3']
        ]));
        $this->UpdateFormField('PopupAlert', 'visible', true);
    }
}

?>