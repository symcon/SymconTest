<?php

	class TimerTest extends IPSModule
	{

		public function Create() {

			// Diese Zeile nicht entfernen
			parent::Create();
			
			// Dieses Beispiel zeigt einen Trick, wie man die protected Funktion "TimerCaller" aus einem Timer starten kann.
			// Einfacher ist die Funktion public zu deklarieren und dann per Prefix_FunktionsName($id) aufzurufen.
			$magic = __FILE__;
			$this->RegisterTimer("Test", 10 * 1000, <<<EOT
				include("$magic");
				class TranslateTestOverride extends TimerTest {
					public function TimerCaller() { 
						parent::TimerCaller();
					}
				}
				(new TranslateTestOverride(\$_IPS['TARGET']))->TimerCaller();
EOT
);

		}
		
		protected function TimerCaller() {
			IPS_LogMessage("TimerTest", "Testing!");
		}
	
	}

?>
