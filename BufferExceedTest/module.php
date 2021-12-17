<?

    class BufferExceedTest extends IPSModule
    {
        private function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public function FillBuffers() {

            for($i = 0; $i <= 500; $i++) {
                $this->SetBuffer($this->generateRandomString(1024), $this->generateRandomString(1024));
            }

        }
    }

?>
