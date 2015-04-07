<?php
namespace frontend\modules\apt\ext\Setster;

class StsApi
{
    private $endPointUrl = "http://www.setster.com/api/v2/";
    private $apiKey = '0b51559cda791b9c2031ffb2114d0a3b';

    private $authToken;

    private function createCmdUrl($cmdPath, $params = array())
    {
        $cmdPath = trim($cmdPath, '/');
        $url = $this->endPointUrl . $cmdPath;

        if (!empty($params)) {
            $url .= '?'.http_build_query($params);
        }
        return $url;
    }

    private function ensure ($expr, $failMsg = '')
    {
        StsApiException::ensure($expr, $failMsg);
    }

    private function decodeResponse($responseRaw, $cmdPath)
    {
        $decodedRes = json_decode($responseRaw, true);
        $this->ensure(!empty($decodedRes), "Something wrong with api result for cmd '{$cmdPath}'");
        return $decodedRes;
    }

    private function appendParamsWithAuthToken(&$params)
    {
        if (!empty($this->authToken)) {
            $params["session_token"] = $this->authToken;
        }
    }

    private function performGetRequest($cmdPath, $params = array())
    {
        $this->appendParamsWithAuthToken($params);

        $cmdUrl = $this->createCmdUrl($cmdPath, $params);
        $curlPerformer = new CurlPerformer(CurlPerformer::METHOD_GET);
        $resRaw = $curlPerformer->fileGetContents($cmdUrl);

        $resReady = $this->decodeResponse($resRaw, $cmdPath);
        return $resReady;
    }

    private function performPostRequest($cmdPath, $params)
    {
        $this->appendParamsWithAuthToken($params);

        $cmdUrl = $this->createCmdUrl($cmdPath);
        $curlPerformer = new CurlPerformer(CurlPerformer::METHOD_POST);
        $resRaw = $curlPerformer->fileGetContents($cmdUrl, $params);

        $resReady = $this->decodeResponse($resRaw, $cmdPath);

        return $resReady;
    }

    public function auth()
    {
        //$cmdUrl = $this->createCmdUrl('account/authenticate');
        $res = $this->performPostRequest('account/authenticate',
            array(
                'email' => 'ekonoval@gmail.com',
                'token' => $this->apiKey
            )
        );

        $this->ensure(
            isset($res["data"]["session_token"])
            && !empty($res["data"]["session_token"]),
            "Can't get api auth token"
        );

        return $res["data"]["session_token"];
    }

    public function createAndSetAuthToken()
    {
        $this->authToken = $this->auth();
    }

    public function getServices()
    {
        $res = $this->performGetRequest('service');
        return $res;
    }

    public function getAccountInfo()
    {
        $res = $this->performGetRequest('account');
        return $res;
    }

    public function getSubAccounts()
    {
        return $this->performGetRequest('account/companies');
    }

    public function getEmployees()
    {
        return $this->performGetRequest('employee');
    }

    public function getClients()
    {
        return $this->performGetRequest('client');
    }

    public function getAvailability($params = array())
    {
        return $this->performGetRequest('availability', $params);
    }
}
