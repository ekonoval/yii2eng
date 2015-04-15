<?php
namespace frontend\modules\apt\ext\Setster;

class CurlPerformer
{
    const METHOD_GET = 1;
    const METHOD_POST = 2;
    const METHOD_PUT = 3;
    const METHOD_DELETE = 4;

    private $method;

    function __construct($method)
    {
        $this->method = $method;
    }

    function fileGetContents($url, $params = array())
    {
        $curl_handler = curl_init($url);
        curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handler, CURLOPT_FOLLOWLOCATION, 1); // required for vticket

        if ($this->method == self::METHOD_POST) {
            curl_setopt($curl_handler, CURLOPT_POST, 1);
            //curl_setopt($curl_handler, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2&postvar3=value3");
            $paramsStr = http_build_query($params);
            curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $paramsStr);
        } elseif ($this->method == self::METHOD_PUT) {
            curl_setopt($curl_handler, CURLOPT_CUSTOMREQUEST, "PUT");
            $paramsStr = http_build_query($params);
            curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $paramsStr);
        }

        $response = curl_exec($curl_handler);
        curl_close($curl_handler);
        return $response;
    }
}
