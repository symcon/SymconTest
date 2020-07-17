<?

	include_once __DIR__ . '/../libs/WebOAuthModule.php';

	class OAuthTest extends WebOAuthModule {
		
		//This one needs to be available on our OAuth client backend.
		//Please contact us to register for an identifier: https://www.symcon.de/kontakt/#OAuth
		private $oauthIdentifer = "test";
		//private $oauthIdentifer = "test_staging";

		//You normally do not need to change this
		private $oauthServer = "oauth.ipmagic.de";
		//private $oauthServer = "oauth.symcon.cloud";

		public function __construct($InstanceID)
		{
			parent::__construct($InstanceID, $this->oauthIdentifer);
		}

		public function Create() {
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("Token", "");

		}
	
		public function ApplyChanges() {
			//Never delete this line!
			parent::ApplyChanges();
		}
	
		/**
		* This function will be called by the register button on the property page!
		*/
		public function Register() {
			
			//Return everything which will open the browser
			return "https://".$this->oauthServer."/authorize/".$this->oauthIdentifer."?username=".urlencode(IPS_GetLicensee());
			
		}
		
		private function FetchRefreshToken($code) {
			
			$this->SendDebug("FetchRefreshToken", "Use Authentication Code to get our precious Refresh Token!", 0);
			
			//Exchange our Authentication Code for a permanent Refresh Token and a temporary Access Token
			$options = array(
				'http' => array(
					'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
					'method'  => "POST",
					'content' => http_build_query(Array("code" => $code))
				)
			);
			$context = stream_context_create($options);
			$result = file_get_contents("https://".$this->oauthServer."/access_token/".$this->oauthIdentifer, false, $context);

			$data = json_decode($result);
			
			if(!isset($data->token_type) || $data->token_type != "Bearer") {
				die("Bearer Token expected");
			}
			
			//Save temporary access token
			$this->FetchAccessToken($data->access_token, time() + $data->expires_in);

			//Return RefreshToken
			return $data->refresh_token;

		}
		
		/**
		* This function will be called by the OAuth control. Visibility should be protected!
		*/
		protected function ProcessOAuthData() {

			//Lets assume requests via GET are for code exchange. This might not fit your needs!
			if($_SERVER['REQUEST_METHOD'] == "GET") {
		
				if(!isset($_GET['code'])) {
					die("Authorization Code expected");
				}
				
				$token = $this->FetchRefreshToken($_GET['code']);
				
				$this->SendDebug("ProcessOAuthData", "OK! Let's save the Refresh Token permanently", 0);

				IPS_SetProperty($this->InstanceID, "Token", $token);
				IPS_ApplyChanges($this->InstanceID);
			
			} else {
				
				//Just print raw post data!
				echo file_get_contents("php://input");
				
			}

		}
		
		private function FetchAccessToken($Token = "", $Expires = 0) {
			
			//Exchange our Refresh Token for a temporary Access Token
			if($Token == "" && $Expires == 0) {
				
				//Check if we already have a valid Token in cache
				$data = $this->GetBuffer("AccessToken");
				if($data != "") {
					$data = json_decode($data);
					if(time() < $data->Expires) {
						$this->SendDebug("FetchAccessToken", "OK! Access Token is valid until ".date("d.m.y H:i:s", $data->Expires), 0);
						return $data->Token;
					}
				}

				$this->SendDebug("FetchAccessToken", "Use Refresh Token to get new Access Token!", 0);

				//If we slipped here we need to fetch the access token
				$options = array(
					"http" => array(
						"header" => "Content-Type: application/x-www-form-urlencoded\r\n",
						"method"  => "POST",
						"content" => http_build_query(Array("refresh_token" => $this->ReadPropertyString("Token")))
					)
				);
				$context = stream_context_create($options);
				$result = file_get_contents("https://".$this->oauthServer."/access_token/".$this->oauthIdentifer, false, $context);

				$data = json_decode($result);
				
				if(!isset($data->token_type) || $data->token_type != "Bearer") {
					die("Bearer Token expected");
				}
				
				//Update parameters to properly cache it in the next step
				$Token = $data->access_token;
				$Expires = time() + $data->expires_in;
				
				//Update Refresh Token if we received one! (This is optional)
				if(isset($data->refresh_token)) {
					$this->SendDebug("FetchAccessToken", "NEW! Let's save the updated Refresh Token permanently", 0);

					IPS_SetProperty($this->InstanceID, "Token", $data->refresh_token);
					IPS_ApplyChanges($this->InstanceID);
				}
				
				
			}

			$this->SendDebug("FetchAccessToken", "CACHE! New Access Token is valid until ".date("d.m.y H:i:s", $Expires), 0);
			
			//Save current Token
			$this->SetBuffer("AccessToken", json_encode(Array("Token" => $Token, "Expires" => $Expires)));
			
			//Return current Token
			return $Token;
			
		}
		
		private function FetchData($url) {
			
			$opts = array(
			  "http"=>array(
				"method" => "POST",
				"header" => "Authorization: Bearer " . $this->FetchAccessToken() . "\r\n" . "Content-Type: application/json" . "\r\n",
				"content" => "{\"JSON-KEY\":\"THIS WILL BE LOOPED BACK AS RESPONSE!\"}",
			  	"ignore_errors" => true
			  )
			);
			$context = stream_context_create($opts);

			$result = file_get_contents($url, false, $context);

			if ((strpos($http_response_header[0], '200') === false)) {
				echo $http_response_header[0] . PHP_EOL . $result;
				return false;
			}

			return $result;

		}
		
		public function RequestStatus() {
			
			echo $this->FetchData("https://".$this->oauthServer."/forward");
			
		}
		
	}

?>
