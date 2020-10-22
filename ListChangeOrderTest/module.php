<?

    class ListChangeOrderTest extends IPSModule
    {
        public function Create() {
            parent::Create();

            $this->RegisterPropertyString('List', '[]');
        }

        public function SetChangeOrder(bool $ChangeOrder) {
            $this->UpdateFormField('List', 'changeOrder', $ChangeOrder);
        }
    }
    
?>
