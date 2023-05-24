<?php

	include_once __DIR__ . '/../libs/WebHookModule.php';

	class HookServe extends WebHookModule {

		public function __construct($InstanceID)
		{
			parent::__construct($InstanceID, "hookserve");
		}		
		
		public function Create() {
			//Never delete this line!
			parent::Create();
			
		}
	
		public function ApplyChanges() {
			//Never delete this line!
			parent::ApplyChanges();			
		}

		/**
		* This function will be called by the hook control. Visibility should be protected!
		*/
		protected function ProcessHookData() {
			
			$root = realpath(__DIR__ . "/www");

			//reduce any relative paths. this also checks for file existence
			$path = realpath($root . "/" . substr($_SERVER['SCRIPT_NAME'], strlen("/hook/hookserve/")));
			if($path === false) {
				http_response_code(404);
				die("File not found!");
			}
			
			if(substr($path, 0, strlen($root)) != $root) {
				http_response_code(403);
				die("Security issue. Cannot leave root folder!");
			}

			//check dir existence
            if(substr($_SERVER['SCRIPT_NAME'], -1) != "/") {
				if(is_dir($path)) {
                    http_response_code(301);
                    header("Location: " . $_SERVER['SCRIPT_NAME'] . "/\r\n\r\n");
                    return;
				}
			}

            //append index
            if(substr($_SERVER['SCRIPT_NAME'], -1) == "/") {
				if(file_exists($path . "/index.html")) {
                    $path .= "/index.html";
				} else if(file_exists($path . "/index.php")) {
                    $path .= "/index.php";
                }
            }

			$extension = pathinfo($path, PATHINFO_EXTENSION);

			if($extension == "php") {
				include_once($path);
			} else {
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

?>
