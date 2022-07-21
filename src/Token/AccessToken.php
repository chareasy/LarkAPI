<?php

namespace CharEasy\LarkApi\Token;

use GuzzleHttp\Client;

/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/20
 * Time: 21:17.
 */
class AccessToken
{
    private $_appId;
    private $_appSecret;

    private $_apiUrl = 'https://open.feishu.cn/open-apis/auth/v3/app_access_token/internal';

//    private $_apiUrl = 'https://open.feishu.cn/open-apis/auth/v3/app_access_token/internal';

    public function __construct($appid, $appSecret)
    {
        $this->_appId = $appid;
        $this->_appSecret = $appSecret;
    }

    public function getAccessToken()
    {
        $client = new Client();
        $header = [
            'content-type' => 'application/json; charset=utf-8',
        ];
        $params = [];
        $params['app_id'] = $this->_appId;
        $params['app_secret'] = $this->_appSecret;
        $response = $client->request('POST', $this->_apiUrl, [
            'headers' => $header,
            'body'    => json_encode($params),
        ]);
        $httpCode = $response->getStatusCode();
        if ($httpCode == 200) {
            return json_decode($response->getBody()->getContents(), 1);
        } else {
            return [];
        }
    }
}
