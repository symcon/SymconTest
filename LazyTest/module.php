<?

    class LazyTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyString('Text', '');
            $this->RegisterPropertyString('TreeData', '[]');
        }
    }

?>
