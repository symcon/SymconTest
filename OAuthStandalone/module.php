<?php

	include_once __DIR__ . '/../libs/WebHookModule.php';
	include_once __DIR__ . '/../libs/vendor/autoload.php';

	class OAuthStandalone extends WebHookModule {

		public function __construct($InstanceID)
		{
			parent::__construct($InstanceID, "oauth/standalone");
		}

		public function Create() {
			//Never delete this line!
			parent::Create();

			$this->RegisterPropertyString("ClientID", "");
			$this->RegisterPropertyString("ClientSecret", "");
			$this->RegisterPropertyString("AuthorizeUri", "");
			$this->RegisterPropertyString("TokenUri", "");
			$this->RegisterPropertyString("Scopes", "");

			$this->RegisterAttributeString("Token", "");
		}
	
		public function ApplyChanges() {
			//Never delete this line!
			parent::ApplyChanges();
		}
	
		public function GetConfigurationForm()
		{
			
			$data = json_decode(file_get_contents(__DIR__ . "/form.json"));
			$data->actions[1]->value = $this->Register();
			$data->actions[2]->caption = $this->ReadAttributeString("Token") ? "Token: Yes" : "Token: Not registered yet";
			return json_encode($data);
		}

		/**
		* This function will be called by the register button on the property page!
		*/
		public function Register() {

			$cc_id = IPS_GetInstanceListByModuleID("{9486D575-BE8C-4ED8-B5B5-20930E26DE6F}")[0];

			//Return everything which will open the browser
			return CC_GetConnectURL($cc_id)."/hook/oauth/standalone";
			
		}

		private function GetProvider() {

			return new \League\OAuth2\Client\Provider\GenericProvider([
				'clientId'                => $this->ReadPropertyString("ClientID"),
				'clientSecret'            => $this->ReadPropertyString("ClientSecret"),
				'redirectUri'             => $this->Register(),
				'urlAuthorize'            => $this->ReadPropertyString("AuthorizeUri"),
				'urlAccessToken'          => $this->ReadPropertyString("TokenUri"),
				'urlResourceOwnerDetails' => null,
			]);

		}

		/**
		* This function will be called by the OAuth control. Visibility should be protected!
		*/
		protected function ProcessHookData() {

			$provider = $this->GetProvider();

			// If we don't have an authorization code then get one
			if (!isset($_GET['code'])) {

				// Fetch the authorization URL from the provider; this returns the
				// urlAuthorize option and generates and applies any necessary parameters
				// (e.g. state).
				$authorizationUrl = $provider->getAuthorizationUrl();

				// Get the state generated for you and store it to the session.
				$this->SetBuffer("State", $provider->getState());

				// Redirect the user to the authorization URL.
				header('Location: ' . $authorizationUrl);
				exit;

			// Check given state against previously stored one to mitigate CSRF attack
			} elseif ($_GET['state'] === $this->GetBuffer("State")) {

				try {

					// Try to get an access token using the authorization code grant.
					$accessToken = $provider->getAccessToken('authorization_code', [
						'code' => $_GET['code']
					]);

					// We have an access token, which we may use in authenticated
					// requests against the service provider's API.
					$this->SendDebug('Access Token', $accessToken->getToken(), 0);
					$this->SendDebug('Refresh Token', $accessToken->getRefreshToken(), 0);
					$this->SendDebug('Expired in', $accessToken->getExpires(), 0);
					$this->SendDebug('Already expired?', ($accessToken->hasExpired() ? 'expired' : 'not expired'), 0);

					// Save into persistence
					$this->WriteAttributeString("Token", json_encode($accessToken));

					echo "<b>Success! You can now close this window.</b>";

				} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

					// Failed to get the access token or user details.
					exit($e->getMessage());

				}

			} else {

				die("Invalid state!");

			}

		}

		public function Request($Uri) {

			$provider = $this->GetProvider();

			$accessToken = new League\OAuth2\Client\Token\AccessToken(
				json_decode($this->ReadAttributeString("Token"), true)
			);

			// The provider provides a way to get an authenticated API request for
			// the service, using the access token; it returns an object conforming
			// to Psr\Http\Message\RequestInterface.
            $request = $provider->getAuthenticatedRequest(
                'GET',
                $Uri,
				$accessToken
            );

			$this->SendDebug("Request", print_r($request->getHeaders(), true), 0);

			$client = new Ivory\HttpAdapter\CurlHttpAdapter();

			$httpResponse = $client->sendRequest($request);

			return (string) $httpResponse->getBody();

		}
	}

?>
