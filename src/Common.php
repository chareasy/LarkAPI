<?php
/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/25
 * Time: 14:51.
 */

namespace CharEasy\LarkApi;

class Common
{
    public string $_baseUrl = 'https://open.feishu.cn/open-apis/';
    public string $_token;

    public function __construct($token)
    {
        $this->_token = $token;
    }
}
