<?php

	include_once __DIR__ . '/../libs/WebHookModule.php';

	class HookServeSimple extends WebHookModule {

		public function __construct($InstanceID)
		{
			parent::__construct($InstanceID, "hookservesimple");
		}		
		
		public function Create() {
			//Never delete this line!
			parent::Create();

			$this->RegisterPropertyInteger('MediaID', 0);
		}
	
		public function ApplyChanges() {
			//Never delete this line!
			parent::ApplyChanges();			
		}

		/**
		* This function will be called by the hook control. Visibility should be protected!
		*/
		protected function ProcessHookData() {
			$path = '';
			if ($_SERVER['SCRIPT_NAME'] === '/hook/hookservesimple/text') {
				$path = __DIR__ . '/test.txt';
			}
			else if (($_SERVER['SCRIPT_NAME'] === '/hook/hookservesimple/media') && IPS_MediaExists($this->ReadPropertyInteger('MediaID'))) {
				$path = IPS_GetKernelDir() . '/' . IPS_GetMedia($this->ReadPropertyInteger('MediaID'))['MediaFile'];
			}
			else {
				http_response_code(404);
				die("File not found!");
			}

			$extension = pathinfo($path, PATHINFO_EXTENSION);

			$this->SendDebug('Path', $path, 0);

			$mimeType = $this->GetMimeType($extension);
			header("Content-Type: " . $mimeType);

			//Add caching support
			$etag = md5_file($path);
			header("ETag: " . $etag);
			if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && (trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag)) { 
				http_response_code(304);
				return;
			}
			
			//Add gzip compression
			if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && $this->IsCompressionAllowed($mimeType)) {
				$compressed = gzencode(file_get_contents($path));
				header("Content-Encoding: gzip");
				header("Content-Length: " . strlen($compressed));
				echo $compressed;
			} else {
				header("Content-Length: " . filesize($path));
				readfile($path);
			}

		}
		
		private function IsCompressionAllowed($mimeType) {
			return in_array($mimeType, [
				"text/plain", 
				"text/html", 
				"text/xml", 
				"text/css", 
				"text/javascript", 
				"application/xml", 
				"application/xhtml+xml", 
				"application/rss+xml", 
				"application/json", 
				"application/json; charset=utf-8", 
				"application/javascript", 
				"application/x-javascript", 
				"image/svg+xml"
			]);
		}
		
		private function GetMimeType($extension) {

			$lines = file(IPS_GetKernelDirEx()."mime.types");
			foreach($lines as $line) {
				$type = explode("\t", $line, 2);
				if(sizeof($type) == 2) {
					$types = explode(" ", trim($type[1]));
					foreach($types as $ext) {
						if($ext == $extension) {
							return $type[0];
						}
					}
				}
			}
			return "text/plain";

		}

	}
