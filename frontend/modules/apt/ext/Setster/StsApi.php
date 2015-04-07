<?php
namespace frontend\modules\apt\ext\Setster;

class StsApi
{
    private $endPointUrl = "http://www.setster.com/api/v2/";
    private $apiKey = '0b51559cda791b9c2031ffb2114d0a3b';

    private function createCmdUrl($cmdPath, $params = array())
    {
        $url = $this->endPointUrl . $cmdPath;
        return $url;
    }

    private function ensure ($expr, $failMsg = '')
    {
        StsApiException::ensure($expr, $failMsg);
    }

    private function decodeResponse($responseRaw)
    {
        return json_decode($responseRaw, true);
    }

    private function performPostRequest($cmdPath, $params)
    {
        $cmdUrl = $this->createCmdUrl($cmdPath);
        $curlPerformer = new CurlPerformer(CurlPerformer::METHOD_POST);
        $resRaw = $curlPerformer->fileGetContents($cmdUrl, $params);

        $resReady = $this->decodeResponse($resRaw);
        $this->ensure(!empty($resReady), "Something wrong with api result for cmd '{$cmdPath}'");

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
}
