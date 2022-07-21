<?php
/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/21
 * Time: 14:58.
 */

namespace CharEasy\LarkApi\Contact\User;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class User
{
    private string $_apiUrl = 'https://open.feishu.cn/open-apis/contact/v3/users/batch_get_id';

    /**
     * @param $token
     * @param $tel
     *
     * @return array|mixed
     *
     * @throws GuzzleException
     */
    public function getUserId($token, $tel)
    {
        $header = [
            'content-type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer '.$token,
        ];
        $params = ['mobiles' => $tel];
        $client = new Client();
        $response = $client->request('POST', $this->_apiUrl, [
            'headers' => $header,
            'verify' => false,
            'body' => json_encode($params),
        ]);

        $httpCode = $response->getStatusCode();
        if (200 == $httpCode) {
            return json_decode($response->getBody()->getContents(), 1);
        } else {
            return [];
        }
    }
}
