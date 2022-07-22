<?php
/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/21
 * Time: 16:03.
 */

namespace CharEasy\LarkApi\Message;

use GuzzleHttp\Client;

class Message
{
    private string $_apiUrl = 'https://open.feishu.cn/open-apis/im/v1/messages';

    public function sendMsg($token, $id, $content)
    {
        $client = new Client();
        $header = [
            'content-type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer '.$token,
        ];

        var_dump($header);
        $query = [];
        $query['receive_id_type'] = 'chat_id';

        $this->_apiUrl = $this->_apiUrl.'?'.http_build_query($query);

//        var_dump($this->_apiUrl);die();

//        die();
        $params = [];
        $params['receive_id'] = $id;
//        $params['page_token'] = '';
//        $params['page_size'] = 100;
        $params['content'] = $content;
        $params['msg_type'] = 'text';
        $response = $client->request('POST', $this->_apiUrl, [
            'header' => $header,
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
