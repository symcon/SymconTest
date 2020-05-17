<?php

declare(strict_types=1);
//Constants will be defined with IP-Symcon 5.0 and newer
if (!defined('IPS_KERNELMESSAGE')) {
    define('IPS_KERNELMESSAGE', 10100);
}
if (!defined('KR_READY')) {
    define('KR_READY', 10103);
}

class WebOAuthModule extends IPSModule
{
    private $oauth = '';

    public function __construct($InstanceID, $oauth)
    {
        parent::__construct($InstanceID);

        $this->oauth = $oauth;
    }

    public function Create()
    {

        //Never delete this line!
        parent::Create();

        //We need to call the RegisterOAuth function on Kernel READY
        $this->RegisterMessage(0, IPS_KERNELMESSAGE);
    }

    public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
    {

        //Never delete this line!
        parent::MessageSink($TimeStamp, $SenderID, $Message, $Data);

        if ($Message == IPS_KERNELMESSAGE && $Data[0] == KR_READY) {
            $this->RegisterOAuth($this->oauth);
        }
    }

    public function ApplyChanges()
    {

        //Never delete this line!
        parent::ApplyChanges();

        //Only call this in READY state. On startup the WebOAuth instance might not be available yet
        if (IPS_GetKernelRunlevel() == KR_READY) {
            $this->RegisterOAuth($this->oauth);
        }
    }

    private function RegisterOAuth($WebOAuth): void
    {
        $ids = IPS_GetInstanceListByModuleID('{F99BF07D-CECA-438B-A497-E4B55F139D37}');
        if (count($ids) > 0) {
            $clientIDs = json_decode(IPS_GetProperty($ids[0], 'ClientIDs'), true);
            $found = false;
            foreach ($clientIDs as $index => $clientID) {
                if ($clientID['ClientID'] == $WebOAuth) {
                    if ($clientID['TargetID'] == $this->InstanceID) {
                        return;
                    }
                    $clientIDs[$index]['TargetID'] = $this->InstanceID;
                    $found = true;
                }
            }

            //If no found add a new client for our instanceID
            if (!$found) {
                $clientIDs[] = [
                    'ClientID' => $WebOAuth,
                    'TargetID' => $this->InstanceID
                ];
            }

            IPS_SetProperty($ids[0], 'ClientIDs', json_encode($clientIDs));
            IPS_ApplyChanges($ids[0]);
        }
    }

    /**
     * This function will be called by the OAuth Control. Visibility should be protected!
     */
    protected function ProcessOAuthData()
    {
        $this->SendDebug('WebOAuth', 'Array POST: ' . print_r($_POST, true), 0);
    }
}
