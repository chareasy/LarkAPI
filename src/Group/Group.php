<?php
/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/21
 * Time: 14:40
 */


namespace CharEasy\LarkApi\Group;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Group
{

    private string $_apiUrl = 'https://open.feishu.cn/open-apis/im/v1/chats';

    /**
     * 获取用户或机器人所在的群列表
     * @param $token
     * @param $userId
     * @return array|mixed
     * @throws GuzzleException
     */
    public function getGroupList($token, $userId)
    {
        $client = new Client();
        $header = [
            'content-type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer ' . $token
        ];

        var_dump($header);

//        die();
//        $params = [];
        $params['user_id_type'] = '';
        $params['page_token'] = '';
        $params['page_size'] = 100;
        $response = $client->request('GET', $this->_apiUrl, [
            'header' => $header,
            'verify' => false,
//            'body' => json_encode($params)
        ]);
        $httpCode = $response->getStatusCode();
        if ($httpCode == 200) {
            return json_decode($response->getBody()->getContents(), 1);
        } else {
            return [];
        }

    }

}