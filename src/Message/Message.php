<?php
/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/21
 * Time: 16:03.
 */

namespace CharEasy\LarkApi\Message;

use CharEasy\LarkApi\Common;
use GuzzleHttp\Client;

class Message extends Common
{
    private string $_apiUrl = 'im/v1/messages';

    public function sendMsg($id, $content)
    {
        $client = new Client();
        $header = [
            'content-type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        $query = [];
        $query['receive_id_type'] = 'chat_id';

        $this->_apiUrl = $this->_apiUrl . '?' . http_build_query($query);
        $params = [];
        $params['receive_id'] = $id;
        $params['content'] = json_encode($content, JSON_UNESCAPED_UNICODE);

        $params['msg_type'] = 'interactive';

        $response = $client->request('POST', $this->_baseUrl . $this->_apiUrl, [
            'headers' => $header,
            'verify' => false,
            'body' => json_encode($params, JSON_UNESCAPED_UNICODE),
        ]);
        $httpCode = $response->getStatusCode();

        if (200 == $httpCode) {
            return json_decode($response->getBody()->getContents(), 1);
        } else {
            return [];
        }
    }
}
