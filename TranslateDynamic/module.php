<?php

	class TranslateDynamic extends IPSModule
	{

		private function GetTranslation()
		{
			// Do not name the file locale.json -> It will be read by IP-Symcon and will mess with our translation
			$data = json_decode(file_get_contents(__DIR__ . "/locale_static.json"), true);

			// Add dynamic translation. Or import/merge multiple json files
			return array_merge_recursive($data, [
				"translations" => [
					"de" => [
						"Do Test" => "Jetzt testen!"
					]
				]
			]);
		}

		public function GetConfigurationForm()
		{
			$data = json_decode(file_get_contents(__DIR__ . "/form.json"), true);

			// Pull in static and dynamic translation
			$data = array_merge_recursive($data, $this->GetTranslation());

			$data["actions"][0]["label"] = $this->DoText();
			return json_encode($data);
		}

		public function DoText()
		{
			// You cannot use IPS_Translate externally anymore. Therefore always translate in special functions
			return sprintf($this->Translate("The current time is %s"), date("d.m.y H:i"));
		}

		public function Translate($Text)
		{
			$translation = $this->GetTranslation();
			$language = IPS_GetSystemLanguage();
			$code = explode("_", $language)[0];
			if (isset($translation["translations"])) {
				if (isset($translation["translations"][$language])) {
					if (isset($translation["translations"][$language][$Text])) {
						return $translation["translations"][$language][$Text];
					}
				} else if (isset($translation["translations"][$code])) {
					if (isset($translation["translations"][$code][$Text])) {
						return $translation["translations"][$code][$Text];
					}
				}
			}
			return $Text;
		}

	}

?>
