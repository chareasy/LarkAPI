<?php
/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/25
 * Time: 11:24.
 */


namespace CharEasy\LarkApi\Message\MessageContent;

class MsgContent
{


    /**
     * 获取标题设置模块
     * @param $title
     * @param string $template
     * @return array
     */
    public function getTitleModule($title, string $template = '#'): array
    {
        $module = [];
        $module['header'] = [];
        $module['header']['template'] = $template;
        $module['header']['title'] = [
            'content' => $title,
            'tag' => 'plain_text'
        ];
        return $module;
    }


    /**
     * 设置备注
     * @param $content
     * @return array
     */
    public function getNoteModule($content): array
    {
        $module['tag'] = 'note';
        $module['elements'][] = [
            'content' => $content,
            'tag' => 'lark_md'
        ];
        return $module;
    }

    /**
     * 获取单行横线
     * @return array
     */
    public function getHrModule(): array
    {
        $module['tag'] = 'hr';
        return $module;
    }


    /**
     * 获取双列文本内容
     * @param $firstTitle
     * @param $firstContent
     * @param $secondTitle
     * @param $secondContent
     * @return array
     */
    protected function getDoubleColumnTestModule($firstTitle, $firstContent, $secondTitle, $secondContent): array
    {
        $firstColumnContent = $this->getSingleColumnTextModule($firstTitle, $firstContent);
        $secondColumnContent = $this->getSingleColumnTextModule($secondTitle, $secondContent);

        $module['tag'] = 'div';
        $module['fields'][] = $firstColumnContent;
        $module['fields'][] = $secondColumnContent;
        return $module;
    }


    /**
     * 获取单例文本内容
     * @param $title
     * @param $content
     * @return array
     */
    private function getSingleColumnTextModule($title, $content): array
    {
        $module['is_short'] = 'true';
        $module['text']['content'] = "**$title**\n$content";
        $module['text']['tag'] = "lark_md";
        return $module;
    }

    /**
     * 获取简单文本内容模块
     * @param string $content
     * @return array
     */
    public function getContentModule(string $content): array
    {
        $module['tag'] = 'div';
        $module['text']['tag'] = 'lark_md';
        $module['text']['content'] = $content;

        return $module;

    }

}