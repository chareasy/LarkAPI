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
        $query = [];
        $query['receive_id_type'] = 'chat_id';

        $this->_apiUrl = $this->_apiUrl.'?'.http_build_query($query);
        $params = [];
        $params['receive_id'] = $id;
        $sendContent['text'] = $content;
        $params['content'] = json_encode($sendContent);
        $params['content'] = '{
  "config": {
    "wide_screen_mode": true
  },
  "header": {
    "template": "red",
    "title": {
      "content": "🔔 叮～你有一封圣诞邀请函待查收 🎁",
      "tag": "plain_text"
    }
  },
  "i18n_elements": {
    "zh_cn": [
      {
        "alt": {
          "content": "",
          "tag": "plain_text"
        },
        "img_key": "img_v2_fddd29cd-2846-4a03-aaed-d22878e503fg",
        "tag": "img"
      },
      {
        "tag": "div",
        "text": {
          "content": "圣诞老人赶着麋鹿在平安夜悄悄光临办公楼，为大家带来了丰盛的下午茶～🎅\nBUT...圣诞老人走得太急，忘记带礼物了！！😢\n\n为活跃办公室气氛，增加同事间情谊，我们将举办圣诞礼物交换派对～！🥂",
          "tag": "lark_md"
        }
      },
      {
        "tag": "div",
        "text": {
          "content": "**🎄 圣诞派对时间：**12月24日 14:00-17:00\n\n**🎁 礼物交换方式：**请各位小伙伴们在包装好你准备的礼物之后，附上卡片祝福语，在 12 月 23 日下午 14:00 前交给前台，我们会统一交到圣诞老人手里～",
          "tag": "lark_md"
        }
      }
    ]
  }
}';
        $params['content'] = '{
  "config": {
    "wide_screen_mode": true
  },
  "elements": [
    {
      "fields": [
        {
          "is_short": true,
          "text": {
            "content": "**时间**\n2021-07-25 15:35:00",
            "tag": "lark_md"
          }
        },
        {
          "is_short": true,
          "text": {
            "content": "**地点**\n江苏省、浙江省、上海市",
            "tag": "lark_md"
          }
        }
      ],
      "tag": "div"
    },
    {
      "tag": "div",
      "text": {
        "content": "亲爱的同事们，\n气象😈局发布台风橙色预警，7月26日江浙沪地区预计平均风力可达10级以上。\n建议江浙沪地区同学明日居家办公。如有值班等特殊情况，请各部门视情况安排。\n请同学们关好门窗，妥善安置室外用品，停止一切户外活动，注意保护自身安全。\n如有疑问，请联系[值班号](https://open.feishu.cn/)。",
        "tag": "lark_md"
      }
    },
    {
      "tag": "hr"
    },
    {
      "elements": [
        {
          "content": "[来自应急通知](https://www.open.feishu.cn/)",
          "tag": "lark_md"
        }
      ],
      "tag": "note"
    }
  ],
  "header": {
    "template": "red",
    "title": {
      "content": "【应急通知】7月26日江浙沪地区居家办公通知",
      "tag": "plain_text"
    }
  }
}';
        $params['msg_type'] = 'interactive';

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
