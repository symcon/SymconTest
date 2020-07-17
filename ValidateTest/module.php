<?

    class ValidateTest extends IPSModule
    {

        public function Create() {
            //Never delete this line!
            parent::Create();

        }

        public function UpdateParameter($name, $parameter, $value) {
            $this->UpdateFormField($name, $parameter, $value);
        }
    }

?>
